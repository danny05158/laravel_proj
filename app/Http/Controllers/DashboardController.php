<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index(){
         return view('dashboard');
    }

    public function get_website(){
        return view('dashboard');
    }

}
