<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\OrganizationsExport;
use App\Imports\OrganizationsImport;
use App\Exports\ContactsExport;
use App\Imports\ContactsImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportExportController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function orgExport() 
    {
        return Excel::download(new OrganizationsExport, 'organizations.xlsx');
    }
     
    /**
    * @return \Illuminate\Support\Collection
    */
    public function orgImport() 
    {
        if(request()->file('file')) {
            $data = Excel::import(new OrganizationsImport,request()->file('file'));
            return 'success';
        }
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function contactExport() 
    {
        return Excel::download(new ContactsExport, 'contacts.xlsx');
    }
     
    /**
    * @return \Illuminate\Support\Collection
    */
    public function contactImport() 
    {
        if(request()->file('file')) {
            $data = Excel::import(new ContactsImport,request()->file('file'));
            return 'success';
        }
    }
}
