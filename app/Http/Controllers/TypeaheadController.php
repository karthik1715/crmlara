<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Category;
use App\Models\Segment;
use App\Http\Controllers\Controller;
use App\Repository\IOrganizationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class TypeaheadController extends Controller
{
    # Search Organization Name
    public function autocompleteSearch(Request $request)
    {
        $query = $request->get('query');
        $filterResult = Organization::where('name', 'LIKE', '%'. $query. '%')->get();
        return response()->json($filterResult);
    } 

    # Search Category Name
    public function catgorySearch(Request $request)
    {
        $query = $request->get('query');
        $categoryResult = Category::where('name', 'LIKE', '%'. $query. '%')->get();
        return response()->json($categoryResult);
    } 

    # Search Segment Name
    public function segmentSearch(Request $request)
    {
        $query = $request->get('query');
        $segmentResult = Segment::with('contacts')->where('name', 'LIKE', '%'. $query. '%')->get();
        return response()->json($segmentResult);
    } 
}