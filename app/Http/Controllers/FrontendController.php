<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public  function index()
    {
        return view('welcome');
    }

    public function booking()
    {
        return view('booking_create');
    }
}
