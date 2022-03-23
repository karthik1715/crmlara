<?php

namespace App\Http\Controllers;

use App\Models\Segment;
use App\Models\Contact;
use App\Http\Controllers\Controller;
use App\Repository\ISegmentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class SegmentController extends Controller
{
    public function __construct(ISegmentRepository $segment)
    {
        $this->segment = $segment;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function showSegments(Request $request)
    {
        $collection = $request->except(['_token','_method']);
        $segments = $this->segment->getAllSegments($collection);
        return View::make('admin.marketing.segment.segment', compact('segments'));
    }
    
    /**
     * Show the form for creating or updating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function createSegment( $campaign = null )
    {
        $campsegment = $campaign;
        $contacts = Contact::paginate(config('global.pagination_records'));
        return View::make('admin.marketing.segment.form', compact('contacts','campsegment'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Segment  $segment
     * @return \Illuminate\Http\Response
     */

    public function getSegment($id)
    {
        $segment = $this->segment->getSegmentById($id);
        $contacts = Contact::paginate(config('global.pagination_records'));
        return View::make('admin.marketing.segment.form', compact('segment','contacts'));
    }
    
    /**
     * Add or Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Segment  $segment
     * @return \Illuminate\Http\Response
     */

    public function saveSegment(Request $request, $id = null)
    {   
        $collection = $request->except(['_token','_method']);
        $campsegment = $collection['campsegment'];
        
        if( ! is_null( $id ) )  {
            $this->segment->createOrUpdate($id, $collection);
            $message =  __('app.segment.update-success');
        }
        else {
            $data = $this->segment->createOrUpdate($id = null, $collection);
            $message =  __('app.segment.create-success');
        }
        if($campsegment == 'campaign') {
            return "<script>alert('".$message ."');window.close();</script>";
        } else {
            return redirect()->route('segment.list')->with('success',$message);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Segment  $segment
     * @return \Illuminate\Http\Response
     */

    public function deleteSegment($id)
    {
        $this->segment->deleteSegment($id);
        $message =  __('app.segment.delete-success');
        return redirect()->route('segment.list')->with('success',$message);
    }

    public function copySegment($id)
    {
        $this->segment->copySegment($id);
        $message =  __('app.segment.create-success');
        return redirect()->route('segment.list')->with('success',$message);
    }
    
}
