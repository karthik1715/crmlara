<?php 

namespace App\Repository;

use App\Models\Campaign;
use App\Models\CampaignDetail;
use App\Models\Segment;
use App\Repository\ICampaignRepository;
use App\Http\Resources\CampaignResource;
use Illuminate\Support\Carbon;
use App\Mail\SendMail;
use App\Jobs\SendEmailJob;

class CampaignRepository implements ICampaignRepository
{   
    protected $campaign = null;

    public function getAllCampaigns( $collection = [] )
    {
        $campaigns = Campaign::orderBy('id','DESC');
        if( isset($collection['q']) && ($collection['q'] != '') ){
            
            $searchData = $collection['q'] ?? '';
            $campaigns->when($searchData, function ($q) use($searchData) { 
                return $q->orWhere('name', 'like', '%'. $searchData . '%');
            });

        }

        $campaignlists = $campaigns->paginate(config('global.pagination_records'));
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
                    $result = $this->sendEmail($collection['segment_id'],$collection['template_content']);
                    
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
            $campaignDetail = CampaignDetail::where('campaign_id', $campaign->id)->firstOrFail();
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

                $result = self::sendEmail($collection['segment_id'],$collection['template_content']);
                
            } else {
                if( isset($collection['schedule_datetime']) && ($collection['schedule_datetime'] != '') && ($collection['schedule_datetime'] != '1969-12-31 00:00:00' ) ){
                    $campaignDetail->schedule_datetime          = $collection['schedule_datetime'];
                } else {
                    $campaignDetail->schedule_datetime          = NULL;
                    $campaignDetail->campaign_status            = 'draft';
                }
            }

            $campaignDetail->save();

            // $segment = Segment::find($collection['segment_id']);
            // echo "<PRE>";
            // print_r($segment->contacts->pluck('id'));
            
            $message =  __('app.campaigns.update-success');
            return ['success' => $message, 'campaign_status' => $campaignDetail->campaign_status, 'campaign_datetime' => $campaignDetail->schedule_datetime];
        }
    }
    
    public function deleteCampaign($id)
    {
        return Campaign::find($id)->delete();
    }

    public function sendEmail($segment_id,$content)
    {
        $segment = Segment::find($segment_id);
            
        if( $segment) {

            foreach($segment->contacts as $contact) {
                $template_content = $content;
                $count =  preg_match_all('#\{\%(.*?)\%\}#', $template_content, $match);
                if( $count > 0 ) {
                   
                    for( $i = 0; $i < $count; $i++ ) {
                        
                        if (!empty( $match[$i])) {
                            $jcount =  count($match[$i]); 
                            for( $j = 0; $j < $jcount; $j++ ) {

                                if(($match[$i][$j]) == '{% user_name %}') {
                                    $template_content = str_replace( $match[$i][$j], $contact->name, $template_content);
                                }

                                if(($match[$i][$j]) == '{% user_email %}') {
                                    $template_content = str_replace( $match[$i][$j], $contact->email, $template_content);
                                }

                                if(($match[$i][$j]) == '{% user_phone %}') {
                                    $template_content = str_replace( $match[$i][$j], $contact->phone, $template_content);
                                }
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
        
    }

}