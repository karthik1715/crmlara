<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Controllers\Controller;
use App\Repository\IContactRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ContactController extends Controller
{
    public function __construct(IContactRepository $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function showContacts(Request $request)
    {
        $collection = $request->except(['_token','_method']);
        $contacts = $this->contact->getAllContacts($collection);
        return View::make('admin.contact.contact', compact('contacts'));
        // return response()->json($contacts, '200');
    }
    
    /**
     * Show the form for creating or updating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function createContact()
    {
        return View::make('admin.contact.form');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */

    public function getContact($id)
    {
        $contact = $this->contact->getContactById($id);
        return View::make('admin.contact.form', compact('contact'));
    }
    
    /**
     * Add or Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */

    public function saveContact(Request $request, $id = null)
    {   
        $collection = $request->except(['_token','_method']);
        
        if( ! is_null( $id ) ) 
        {
            $this->contact->createOrUpdate($id, $collection);
            $message =  __('app.contacts.person.update-success');
        }
        else
        {
            $data = $this->contact->createOrUpdate($id = null, $collection);
            $message =  __('app.contacts.person.create-success');
        }

        return redirect()->route('contact.list')->with('success',$message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */

    public function deleteContact($id)
    {
        $this->contact->deleteContact($id);
        $message =  __('app.contacts.person.delete-success');
        return redirect()->route('contact.list')->with('success',$message);
    }

    public function checkEmail(Request $request)
    {
        $collection = $request->except(['_token','_method']);
        $email = $collection['email'];
        $response = $this->contact->checkEmail($email);
        return $response;
    }
    
}
