<?php 

namespace App\Repository;

use App\Models\Segment;
use App\Repository\ISegmentRepository;
use App\Http\Resources\SegmentResource;
use App\Traits\ImageTrait;

class SegmentRepository implements ISegmentRepository
{   
    use ImageTrait;
    
    protected $segment = null;

    public function getAllSegments( $collection = [], $pagLimit= null )
    {
        $segments = Segment::orderBy('id','DESC');
        if( isset($collection['seg_search']) && ($collection['seg_search'] != '') ){
            
            $searchData = $collection['seg_search'] ?? '';
            $segments->when($searchData, function ($q) use($searchData) { 
                return $q->orWhere('name', 'like', '%'. $searchData . '%')
                         ->orWhere('description', 'like', '%'. $searchData . '%');
            });
        }

        if( $pagLimit == 'all') {
            $segmentlists  = $segments->where('status', '=', 'active')->get();
        } else {
            $segmentlists  = $segments->paginate(config('global.pagination_records'));
        }

        $segmentsResources = SegmentResource::collection($segmentlists);
        return $segmentsResources;
    }

    public function getSegmentById($id)
    {
        return Segment::find($id);
    }

    public function createOrUpdate( $id = null, $collection = [] )
    {   
        if(is_null($id)) {

            $segment = new Segment;
            $segment->name              = $collection['name'];
            $segment->description       = $collection['description'];
            $segment->created_by        = auth()->id();
            
            $result = $segment->save();
            if ($result) {
                $segment->contacts()->attach($collection['contact_id']);
            }

            return $result;
        }
        
        $segment                    = Segment::find($id);
        $segment->name              = $collection['name'];
        $segment->description       = $collection['description'];
        $segment->updated_by        = auth()->id();

        $result = $segment->save();
        if ($result) {
            $segment->contacts()->sync($collection['contact_id']);
        }

        return $result;
    }
    
    public function deleteSegment($id)
    {
        $segment = Segment::find($id);
        $segment->contacts()->detach();
        return $segment->delete();
    }

    public function copySegment($id)
    {
        $segment                = Segment::find($id);
        $newsegment             = $segment->replicate();
        $newsegment->name       = rand(1,9999).$segment->name;
        $result                 = $newsegment->save();

        $newsegment->push(); //Push before to get id of $clone
        
        if ($result) {
            // foreach($segment->contacts as $contact)
            {
                $newsegment->contacts()->attach($segment->contacts);
            }
        }
        return $result;
    }
}