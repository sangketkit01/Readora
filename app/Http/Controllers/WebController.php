<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    //
    function sign_in(){
        return view('login.sign_in');
    }

    function sign_up(){
        return view('login.sign_up');
    }

    function forgot(){
        return view('login.forgotpass');
    }
}
