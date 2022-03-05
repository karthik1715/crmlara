<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Http\Controllers\Controller;
use App\Repository\IOrganizationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Session;

class OrganizationController extends Controller
{
    public function __construct(IOrganizationRepository $organization)
    {
        $this->organization = $organization;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function showOrganizations(Request $request)
    {
        $collection = $request->except(['_token','_method']);
        $organizations = $this->organization->getAllOrganizations($collection);
        return View::make('admin.organization.organization', compact('organizations'));
    }
    
    /**
     * Show the form for creating or updating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function createOrganization()
    {
        return View::make('admin.organization.form');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */

    public function getOrganization($id)
    {
        $organization = $this->organization->getOrganizationById($id);
        return View::make('admin.organization.form', compact('organization'));
    }
    
    /**
     * Add or Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */

    public function saveOrganization(Request $request, $id = null)
    {   
        $collection = $request->except(['_token','_method']);
        
        if( ! is_null( $id ) ) 
        {
            $this->organization->createOrUpdate($id, $collection);
            $message =  __('app.contacts.organization.update-success');
        }
        else
        {
            $this->organization->createOrUpdate($id = null, $collection);
            $message =  __('app.contacts.organization.create-success');
        }

        return redirect()->route('organization.list')->with('success',$message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */

    public function deleteOrganization($id)
    {
        $this->organization->deleteOrganization($id);
        $message =  __('app.contacts.organization.delete-success');
        return redirect()->route('organization.list')->with('success',$message);
    }
    
}
