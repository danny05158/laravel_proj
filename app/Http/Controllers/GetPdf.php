<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GetPdf extends Controller
{
    //
    public function __construct(){

    }

    public function index(Request $request ){

        // $data = [];
        // $data['website_url'] = $request->input('website');

        return view('/dashboard');
    }
}
