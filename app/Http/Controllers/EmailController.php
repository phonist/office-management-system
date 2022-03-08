<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailController extends Controller
{
   
    public function inbox()
    {
        //
        return view('email.inbox');
    }
    
    public function compose()
    {
        //
        return view('email.compose');
    }
   
    public function read()
    {
        //
        return view('email.read');
    }
}
