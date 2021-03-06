<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Attributes;
use App\Http\Controllers\Controller;
use App\Repository\ICampaignRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CampaignController extends Controller
{
    public function __construct(ICampaignRepository $campaign)
    {
        $this->campaign = $campaign;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function showCampaigns(Request $request)
    {
        $collection = $request->except(['_token','_method']);
        $campaigns  =  $this->campaign->getAllCampaigns($collection);
        return View::make('admin.campaign.campaign', compact('campaigns'));
    }
    
    /**
     * Show the form for creating or updating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function createCampaign()
    {
        return View::make('admin.campaign.form');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */

    public function getCampaign($id)
    {
        $campaign = $this->campaign->getCampaignById($id);
        return View::make('admin.campaign.form', compact('campaign'));
    }
    
    /**
     * Add or Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */

    public function saveCampaign(Request $request, $id = null)
    {   
        $collection = $request->except(['_token','_method']);
      
        if( ! is_null( $id ) ) {
            $data = $this->campaign->createOrUpdate($id, $collection);
        }
        else {
            $data = $this->campaign->createOrUpdate($id = null, $collection);
        }
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */

    public function deleteCampaign($id)
    {
        $this->campaign->deleteCampaign($id);
        $message =  __('app.campaigns.delete-success');
        return redirect()->route('campaign.list')->with('success',$message);
    }

    public function statisticsCampaign($id)
    {
        $campaign = $this->campaign->statisticsCampaign($id);
        return view('admin.campaign.statistics', compact('campaign'));
    }

    public function checkEmail(Request $request)
    {
        $collection = $request->except(['_token','_method']);
        $email = $collection['email'];
        $response = $this->campaign->checkEmail($email);
        return $response;
    }

    public function uploadImage(Request $request)
    {
        // $accepted_origins = array( config('global.local') , config('global.live') );
        // $accepted_origins = array("http://localhost", "https://coderzvisiontech.com/crm/");
        
        // Images upload path
        $imageFolder = "EditorImages";

        reset($_FILES);
        $temp = current($_FILES);
       
        if(is_uploaded_file($temp['tmp_name'])){
            
            // if(isset($_SERVER['HTTP_ORIGIN'])){
            //     // Same-origin requests won't set an origin. If the origin is set, it must be valid.
            //     if(in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)){
            //         header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
            //     }else{
            //         header("HTTP/1.1 403 Origin Denied");
            //         return;
            //     }
            // }

            // // Sanitize input
            if(preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])){
                header("HTTP/1.1 400 Invalid file name.");
                return;
            }
        
            // // Verify extension
            if(!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png"))){
                header("HTTP/1.1 400 Invalid extension.");
                return;
            }

            // Accept upload if there was no origin, or if it is an accepted origin
            $files = $request->file('file');
            $allowedfileExtension=['jpg','png'];
            $extension = $files->getClientOriginalExtension();
            
            $check=in_array($extension,$allowedfileExtension);
            
            if( $check ) {
                $imageFullName = time().rand(100,9999).'.'.$extension;
                $path = $files->storeAs($imageFolder, $imageFullName);
                // $url = url('/').'/storage/app/';
                $filetowrite = $imageFolder.'/'.$imageFullName;
            }
            echo json_encode(array('location' => $filetowrite));
        }
    }

    public function attributeValue()
    {
        $data           = [];
        $resultArr      = [];
        $attributeArray = [];

        $attributesGroups   = Attributes::select('entity_type', DB::raw('count(*) as total'))
                                ->groupBy('entity_type')
                                ->get();
                        
        $attributes         = Attributes::select('id','name','code','entity_type')
                                ->orderBy('id', 'ASC')
                                ->get();

        foreach($attributesGroups->toArray() as $item) { 
            $resultArr[$item['entity_type']]['count'] = $item['total'];
            $attributeValue = $attributes->where('entity_type',$item['entity_type']);
            
            if( $item['total'] > 1 ) {
                $resultArr[$item['entity_type']]['text']    = ucfirst($item['entity_type']);
                $resultArr[$item['entity_type']]['value']   = $item['entity_type'];

                foreach($attributeValue->toArray() as $multiItems) {
                    $data[$multiItems['entity_type']]['text']     = ucfirst($multiItems['name']);
                    $data[$multiItems['entity_type']]['value']    = $multiItems['entity_type'].'.'.$multiItems['code'];
                    $resultArr[$multiItems['entity_type']]['menu'][]      = $data[$multiItems['entity_type']];
                }

            } else {

                foreach($attributeValue->toArray() as $singleItem) {
                    $data[$singleItem['entity_type']]['count'] = $item['total'];
                    $data[$singleItem['entity_type']]['text']  = ucfirst($singleItem['entity_type']);
                    $data[$singleItem['entity_type']]['value'] = $singleItem['entity_type'].'.'.$singleItem['code'];
                    $resultArr[$item['entity_type']] = $data[$singleItem['entity_type']];
                }

            }
        }
        
        $keys = array_keys($resultArr);
        if( $keys ) {
            for( $i = 0; $i < count($resultArr); $i++ ) {
                $attributeArray[] = $resultArr[$keys[$i]];
            }
        }

        /* $data = array(
            array( "text" => "User Name", 
                   "value" => "user_name",
                   "count" => 3,
                   "menu" => 
                   array( array("text" => "User Name1", 
                          "value" => "user_name1111"),
                          array("text" => "User Name2", 
                          "value" => "user_name2222"),
                          array("text" => "User Name3", 
                          "value" => "user_name3333",) ),

                 ),
            array( "text" => "User Phone", 
                   "value" => "user_phone",
                   "count" => 0 ),
            array( "text" => "Phone Name", 
                "value" => "phone.leaddd",
                "count" => 4,
                "menu" => 
                    array( array("text" => "Ue1", 
                            "value" => "u 111"),
                            array("text" => "2e2", 
                            "value" => "usd2"),
                            array("text" => "U32", 
                            "value" => "ude3333"),
                            array("text" => "U42", 
                            "value" => "ude4444") ),

                 ),
        ); */

        return json_encode($attributeArray);
    }

    public function copyCampaign($id)
    {
        $this->campaign->copyCampaign($id);
        $message =  __('app.campaigns.create-success');
        return redirect()->route('campaign.list')->with('success',$message);
    }
    
}
