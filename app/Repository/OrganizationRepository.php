<?php 

namespace App\Repository;
// namespace App\Services;

use App\Models\Organization;
use App\Repository\IOrganizationRepository;
// use Illuminate\Support\Facades\Hash;
use App\Http\Resources\OrganizationResource;


class OrganizationRepository implements IOrganizationRepository
{   
    protected $organization = null;

    public function getAllOrganizations( $collection = [] )
    {
        $organizations = Organization::orderBy('id','DESC');
        if( isset($collection['org_search']) && ($collection['org_search'] != '') ){
            
            $searchData = $collection['org_search'] ?? '';
            $organizations->when($searchData, function ($q) use($searchData) { 
                return $q->orWhere('name', 'like', '%'. $searchData . '%');
            });

        }
        $organizationlists  = $organizations->paginate(config('global.pagination_records'));
        $organizationsList  = OrganizationResource::collection($organizationlists);
        return $organizationsList;
        // $organizations = Organization::where('id', '=', 1)->paginate(3);
        // return response([ 'projects' => ProjectResource::collection($projects), 'message' => 'Retrieved successfully'], 200);
    }

    public function getOrganizationById($id)
    {
        return Organization::find($id);
    }

    public function createOrUpdate( $id = null, $collection = [] )
    {   
        if(is_null($id)) {
            $organization = new Organization;
            $organization->name = $collection['name'];
            $organization->address = $collection['address'];
            $organization->country_id = $collection['country_id'];
            $organization->state = $collection['state'];
            $organization->city = $collection['city'];
            $organization->postalcode = $collection['postalcode'];
            $organization->created_by = auth()->id();
            return $organization->save();
        }
        $organization = Organization::find($id);
        $organization->name = $collection['name'];
        $organization->address = $collection['address'];
        $organization->country_id = $collection['country_id'];
        $organization->state = $collection['state'];
        $organization->city = $collection['city'];
        $organization->postalcode = $collection['postalcode'];
        $organization->updated_by = auth()->id();
        return $organization->save();
    }
    
    public function deleteOrganization($id)
    {
        return Organization::find($id)->delete();
    }
}