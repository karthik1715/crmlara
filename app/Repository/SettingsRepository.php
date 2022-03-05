<?php 

namespace App\Repository;

use App\Models\Category;
use App\Repository\ISettingsRepository;
use App\Http\Resources\SettingsResource;

class SettingsRepository implements ISettingsRepository
{   
    protected $contact = null;

    public function getAllCategories( $collection = [] )
    {
        $contacts = Category::orderBy('id','DESC');
        if( isset($collection['q']) && ($collection['q'] != '') ){
            
            $searchData = $collection['q'] ?? '';
            $contacts->when($searchData, function ($q) use($searchData) { 
                return $q->orWhere('name', 'like', '%'. $searchData . '%')
                         ->orWhere('email', 'like', '%'. $searchData . '%')
                         ->orWhere('phone', 'like', '%'. $searchData . '%');
            });

        }

        $contactlists = $contacts->paginate(config('global.pagination_records'));
        // $contacts = Category::orderBy('id','DESC')->paginate(config('global.pagination_records'));

        $contactsResources = SettingsResource::collection($contactlists);
        return $contactsResources;
        // return response([ 'projects' => ProjectResource::collection($projects), 'message' => 'Retrieved successfully'], 200);
    }

    public function getCategoryById($id)
    {
        return Category::find($id);
    }

    public function createOrUpdate( $id = null, $collection = [] )
    {   
        if(is_null($id)) {

            $category                    = new Category;
            $category->name              = $collection['name'];
            $category->description       = $collection['description'];
            $category->created_by        = auth()->id();
            
            return $category->save();
        }
        
        $category                    = Category::find($id);
        $category->name              = $collection['name'];
        $category->description       = $collection['description'];
        $category->created_by        = auth()->id();

        return $category->save();
    }
    
    public function deleteCategory($id)
    {
        return Category::find($id)->delete();
    }

    public function checkEmail($email='')
    {
        $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 

        if (preg_match($regex, $email)) {
            $emailcheck = Category::where('email',$email)->count();
            if($emailcheck > 0) {
                echo "Email Already In Use.";
            }
            else {
                echo "Email is available.";
            }
        } else { 
            echo $email . " is an invalid email. Please try again.";
        }           
    }
}