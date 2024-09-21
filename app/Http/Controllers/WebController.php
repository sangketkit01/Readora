<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    //
    function SignIn(){
        return view('login.sign_in');
    }

    function SignUp(){
        return view('login.sign_up');
    }

    function Forgot(){
        return view('login.forgotpass');
    }
}
