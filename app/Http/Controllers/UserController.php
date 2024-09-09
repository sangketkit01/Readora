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

    function update(Request $request){
        $user = Userdb::where('username', Session::get('user')->username)->first();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->gender = $request->input('gender');
        $user->save();
        return redirect()->route('profile')->with('success', 'ข้อมูลผู้ใช้ได้รับการอัปเดตเรียบร้อยแล้ว');

    }
}
