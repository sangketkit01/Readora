<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    //
    function sign_in(){
        return view('all.sign_in');
    }

    function sign_up(){
        return view('all.sign_up');
    }

    function forgot(){
        return view('all.forgotpass');
    }
}
