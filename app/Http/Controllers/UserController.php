<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userdb;
use App\Models\Book;

class UserController extends Controller
{
    //
    function profile(){
        $info = Userdb::all();
        $book = Book::all();
        return view('user.profile', compact('info'));
    }
}
