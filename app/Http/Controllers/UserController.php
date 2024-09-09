<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userdb;
use App\Models\Book;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //
    function profile(){
        $info = Userdb::where('username', Session::get('user')->username)->get();
        // dd(Session::get('user')->username);
        $book = Book::all();
        return view('user.profile', compact('info'));
    }
}
