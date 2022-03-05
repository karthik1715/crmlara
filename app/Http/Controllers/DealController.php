<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class DealController extends Controller
{
    public function index()
    {
        return View::make('admin.deal.deal');
        // echo "hi";
    }
}
