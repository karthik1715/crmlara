<?php 

namespace App\Repository;

use App\Models\Campaign;
use App\Models\CampaignDetail;
use App\Models\Segment;
use App\Models\Attributes;
use App\Repository\ICampaignRepository;
use App\Http\Resources\CampaignResource;
use Illuminate\Support\Carbon;
use App\Mail\SendMail;
use App\Jobs\SendEmailJob;

class CampaignRepository implements ICampaignRepository
{   
    protected $campaign = null;

    public function getAllCampaigns( $collection = [], $pagLimit= null )
    {
        $campaigns = Campaign::orderBy('id','DESC');
        if( isset($collection['q']) && ($collection['q'] != '') ){
            
            $searchData = $collection['q'] ?? '';
            $campaigns->when($searchData, function ($q) use($searchData) { 
                return $q->orWhere('name', 'like', '%'. $searchData . '%')
                         ->orWhere('subject', 'like', '%'. $searchData . '%');
            });

        }

        if( $pagLimit == 'all') {
            $campaignlists = $campaigns->where('status', '=', 'active')->orderBy('id','DESC')->get();
        } else {
            $campaignlists = $campaigns->paginate(config('global.pagination_records'));
        }

        $campaignsResources = CampaignResource::collection($campaignlists);
        return $campaignsResources;
    }

    public function getCampaignById($id)
    {
        return Campaign::find($id);
    }

    public function createOrUpdate( $id = null, $collection = [] )
    {   
        if(is_null($id)) {

            $campaign = new Campaign;
            $campaign->name            = $collection['name'];
            $campaign->subject         = $collection['subject'];
            $campaign->category_id     = $collection['category_id']?:'0';
            $campaign->segment_id      = $collection['segment_id'];
            $campaign->status          = 'active';
            $campaign->created_by      = auth()->id();
            $result                    = $campaign->save();
            $insertedId                = $campaign->id;
            if ( $result ) {
                $campaignDetail = new CampaignDetail;
                $campaignDetail->campaign_id                = $insertedId;
                $campaignDetail->sender_name                = $collection['sender_name'];
                $campaignDetail->sender_email               = $collection['sender_email'];
                $campaignDetail->sender_reply_email_status  = $collection['sender_reply_email_status'];
                $campaignDetail->sender_reply_email         = $collection['sender_reply_email'];
                $campaignDetail->sender_email_service_type  = $collection['sender_email_service_type'];
                $campaignDetail->schedule_status            = $collection['schedule_status'];
                $campaignDetail->template_content           = $collection['template_content'];
                $campaignDetail->campaign_status            = 'active';

                if( $collection['schedule_status'] == 0) {

                    date_default_timezone_set('Asia/Kolkata');
                    $openTime = Carbon::now();
                    $newTime  = Carbon::parse($openTime)->addMinutes(2); // add two minutes
                    $campaignDetail->schedule_datetime          = $newTime;
                    $result = $this->sendEmail($collection['template_content'],$campaign);
                    
                } else {
                    if( isset($collection['schedule_datetime']) && ($collection['schedule_datetime'] != '') ){
                        $campaignDetail->schedule_datetime          = $collection['schedule_datetime'];
                    } else {
                        $campaignDetail->schedule_datetime          = NULL;
                        $campaignDetail->campaign_status            = 'draft';
                    }
                }

                $campaignDetail->save();
                
                $message =  __('app.campaigns.create-success');
                return ['success' => $message, 'campaign_status' => $campaignDetail->campaign_status, 'campaign_datetime' => $campaignDetail->schedule_datetime];
            }
        }
       

        $campaign                    = Campaign::find($id);
        $campaign->name              = $collection['name'];
        $campaign->subject           = $collection['subject'];
        $campaign->category_id       = $collection['category_id']?:'0';
        $campaign->segment_id        = $collection['segment_id'];
        $campaign->status            = 'active';
        $campaign->updated_by        = auth()->id();
        $result                      = $campaign->save();
        if ( $result ) {
            
            $campaignDetail = CampaignDetail::where('campaign_id', $campaign->id)->first();
            if (! $campaignDetail) {
                $campaignDetail = new CampaignDetail;
            }

            $campaignDetail->campaign_id                = $campaign->id;
            $campaignDetail->sender_name                = $collection['sender_name'];
            $campaignDetail->sender_email               = $collection['sender_email'];
            $campaignDetail->sender_reply_email_status  = $collection['sender_reply_email_status'];
            $campaignDetail->sender_reply_email         = $collection['sender_reply_email'];
            $campaignDetail->sender_email_service_type  = $collection['sender_email_service_type'];
            $campaignDetail->schedule_status            = $collection['schedule_status'];
            $campaignDetail->template_content           = $collection['template_content'];
            $campaignDetail->campaign_status            = 'active';

            if( $collection['schedule_status'] == 0) {

                date_default_timezone_set('Asia/Kolkata');
                $openTime = Carbon::now();
                $newTime  = Carbon::parse($openTime)->addMinutes(2); // add two minutes
                $campaignDetail->schedule_datetime          = $newTime;

                $result = self::sendEmail($collection['template_content'],$campaign);
                
            } else {
                if( isset($collection['schedule_datetime']) && ($collection['schedule_datetime'] != '') && ($collection['schedule_datetime'] != '1969-12-31 00:00:00' ) ){
                    $campaignDetail->schedule_datetime          = $collection['schedule_datetime'];
                } else {
                    $campaignDetail->schedule_datetime          = NULL;
                    $campaignDetail->campaign_status            = 'draft';
                }
            }

            $campaignDetail->save();
            
            $message =  __('app.campaigns.update-success');
            return ['success' => $message, 'campaign_status' => $campaignDetail->campaign_status, 'campaign_datetime' => $campaignDetail->schedule_datetime];
        }
    }
    
    public function deleteCampaign($id)
    {
        $campaign = Campaign::find($id)->delete();
        $campaignDetail = CampaignDetail::where('campaign_id',$id);
        return $campaignDetail->delete();
    }

    public function copyCampaign($id)
    {
        $campaign           = Campaign::find($id);
        $newcampaign        = $campaign->replicate();
        $newcampaign->name  = rand(1,999).$campaign->name;
        $result             = $newcampaign->save();
        $insertId           = $newcampaign->id;

        if ($result) {
            
            $campaignDetails  = CampaignDetail::where('campaign_id',$id)->get();
            
            if($campaignDetails) {

                $campaignDetail = new CampaignDetail;
                foreach( $campaignDetails->toarray() as $camp ) {
                    
                    $campaignDetail->campaign_id                = $insertId;
                    $campaignDetail->sender_name                = $camp['sender_name'];
                    $campaignDetail->sender_email               = $camp['sender_email'];
                    $campaignDetail->sender_reply_email_status  = $camp['sender_reply_email_status'];
                    $campaignDetail->sender_reply_email         = $camp['sender_reply_email'];
                    $campaignDetail->sender_email_service_type  = $camp['sender_email_service_type'];
                    $campaignDetail->schedule_status            = 0;
                    $campaignDetail->template_content           = $camp['template_content'];
                    $campaignDetail->campaign_status            = 'draft';

                }
                $cdresult = $campaignDetail->save();
            }
        } 

        return $cdresult;
    }

    public function sendEmail($content,$campaign)
    {
        $segment = Segment::find($campaign->segment_id);
        /* $attributes = Attributes::all();
        $field_name = ''; */
        if( $segment ) {
            
            foreach($segment->contacts as $contact) {
                
                $template_content = $content;
                $count =  preg_match_all('#\{\%(.*?)\%\}#', $template_content, $match);
                
                if( $count > 0 ) {
                   
                    for( $i = 0; $i < $count; $i++ ) {
                        
                        if (!empty( $match[$i])) {
                            $jcount =  count($match[$i]); 
                            for( $j = 0; $j < $jcount; $j++ ) {

                                if(($match[$i][$j]) == '{% contacts.name %}') {
                                    $template_content = str_replace( $match[$i][$j], $contact->name, $template_content);
                                }

                                if(($match[$i][$j]) == '{% contacts.email %}') {
                                    $template_content = str_replace( $match[$i][$j], $contact->email, $template_content);
                                }

                                if(($match[$i][$j]) == '{% contacts.phone %}') {
                                    $template_content = str_replace( $match[$i][$j], $contact->phone, $template_content);
                                }

                                if(($match[$i][$j]) == '{% organizations.name %}') {
                                    $template_content = str_replace( $match[$i][$j], $contact->organization->name, $template_content);
                                }

                                if(($match[$i][$j]) == '{% segments.name %}') {
                                    $template_content = str_replace( $match[$i][$j], $segment->name, $template_content);
                                }

                                if(($match[$i][$j]) == '{% segments.description %}') {
                                    $template_content = str_replace( $match[$i][$j], $segment->description, $template_content);
                                }

                                if(($match[$i][$j]) == '{% campaigns.name %}') {
                                    $template_content = str_replace( $match[$i][$j], $campaign->name, $template_content);
                                }
                                
                                /* foreach($attributes->toArray() as $item6) { 
                                    $field_name = '{% '.$item6['entity_type'].'.'.$item6['code'].' %}';
                                    // echo $field_name;
                                    if(($match[$i][$j]) == $field_name) {
                                        $template_content = str_replace( $match[$i][$j], $contact->email, $template_content);
                                    }
                                } */
                            }
                        }
                    }
                }
                $details = ['email' => $contact->email];
                $details['template_content'] = $template_content;
                $sendmail = SendEmailJob::dispatchNow($details);
                // echo $template_content;
            }
        }
    }

    public function statisticsCampaign($id)
    {
        $campaign  = Campaign::find($id);
        $segment = Segment::find($campaign->segment_id);
        
        if( $segment ) {
            $segment_count = $segment->contacts->count();
        }
        return ['success' => 'success', 'segment_count' => $segment_count];
    }

}