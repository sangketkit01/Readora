<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    function profile(){
        return view('all.profile');
    }

    function unfinish(){
        return view('reader.unfinish_read');
    }
}
