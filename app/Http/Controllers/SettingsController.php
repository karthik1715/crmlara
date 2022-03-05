<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Repository\ISettingsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Session;

class SettingsController extends Controller
{
    public function __construct(ISettingsRepository $settings)
    {
        $this->settings = $settings;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function showCategories(Request $request)
    {
        $collection = $request->except(['_token','_method']);
        $categories = $this->settings->getAllCategories($collection);
        // return View::make('admin.organization.organization', compact('organizations'));
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $settings
     * @return \Illuminate\Http\Response
     */

    public function getCategory($id)
    {
        $categories = $this->settings->getCategoryById($id);
        return View::make('admin.organization.form', compact('organization'));
    }
    
    /**
     * Add or Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $settings
     * @return \Illuminate\Http\Response
     */

    public function saveCategory(Request $request, $id = null)
    {   
        $collection = $request->except(['_token','_method']);
        
        if( ! is_null( $id ) ) 
        {
            $this->settings->createOrUpdate($id, $collection);
            // $message = __('app.settings.category.update-success');
            $message = 'error';
        }
        else
        {
            $this->settings->createOrUpdate($id = null, $collection);
            $message =  'ok';
        }

        return $message;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $settings
     * @return \Illuminate\Http\Response
     */

    public function deleteCategory($id)
    {
        $this->settings->deleteCategory($id);
        $message =  __('app.contacts.organization.delete-success');
        return redirect()->route('organization.list')->with('success',$message);
    }
    
}
