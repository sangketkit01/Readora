<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WebController extends Controller
{
    //
    function SignIn(){
        if(Session::has("user")){
            return redirect()->route("index");
        }
        return view('login.sign_in');
    }

    function SignUp(){
        if (Session::has("user")) {
            return redirect()->route("index");
        }
        return view('login.sign_up');
    }

    function Forgot(){
        return view('login.forgotpass');
    }
}
