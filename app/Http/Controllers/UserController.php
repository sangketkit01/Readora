<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userdb;
use App\Models\Book;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function profile(){
        $user = Userdb::where('username', Session::get('user')->username)->first();
        $novels = Book::where('username', $user->username)->where('bookTypeID', 1)->get();
        $n_count = Book::where('username', $user->username)->where('bookTypeID', 1)->count();
        $comics = Book::where('username', $user->username)->where('bookTypeID', 2)->get();
        $c_count = Book::where('username', $user->username)->where('bookTypeID', 2)->count();
        return view('profile.main', compact('user','novels', 'n_count', 'comics', 'c_count'));
    }

    function editInfoPage($username){
        $user = Userdb::where('username', Session::get('user')->username)->first();
        $n_count = Book::where('username', $user->username)->where('bookTypeID', 1)->count();
        $c_count = Book::where('username', $user->username)->where('bookTypeID', 2)->count();
        return view('profile.main', compact('user', 'username', 'n_count', 'c_count'));
    }
    function edit_info(Request $request){
        $user = Userdb::where('username', Session::get('user')->username)->first();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->gender = $request->input('gender');
        $user->save();
        return redirect()->route('profile');
    }

    function novelInfoPage($username){
        $user = Userdb::where('username', Session::get('user')->username)->first();
        $novel = Book::where('username', $user->username)->where('bookTypeID', 1)->get();
        $n_count = Book::where('username', $user->username)->where('bookTypeID', 1)->count();
        return view('profile.main', compact('user', 'novel', 'username'));
    }

    function comicInfoPage($username){
        $user = Userdb::where('username', Session::get('user')->username)->first();
        $comic = Book::where('username', $user->username)->where('bookTypeID', 2)->get();
        $c_count = Book::where('username', $user->username)->where('bookTypeID', 2)->count();
        return view('profile.main', compact('user', 'comic', 'username'));
    }

    function viewCreatePassword(){
        return view('profile.create_password');
    }
    function create_password(Request $request){
        $request->validate([
            "password" => "min:8",
            "confirm" => "same:password"
        ],[
            "password.min" => "รหัสผ่านต้องมีขั้นต่ำ 8 ตัวอักษร",
            "confirm.same" => "รหัสผ่านไม่ตรงกัน"
        ]);
        $user = Userdb::where('username', Session::get('user')->username)->first();
        $user->password = Hash::make($request->input("password"));
        $user->save();
        return redirect()->route('profile');
    }
    
    function viewChangePassword(){
        return view('profile.change_password');
    }
    function change_password(Request $request){
        $request->validate([
            "current_password" => "required",
            "password" => "min:8",
            "confirm" => "same:password"
        ],[
            "password.min" => "รหัสผ่านต้องมีขั้นต่ำ 8 ตัวอักษร",
            "confirm.same" => "รหัสผ่านไม่ตรงกัน"
        ]);
        $user = Userdb::where('username', Session::get('user')->username)->first();
        if (!Hash::check($request->input('current_password'), $user->password)) {
            echo "<script>alert('รหัสผ่านไม่ตรงกัน') return false;</script>";
        }
        $user->password = Hash::make($request->input("n-password"));
        $user->save();
        return redirect()->route('profile')->with('status', 'เปลี่ยนรหัสผ่านเรียบร้อยแล้ว');
    }
    
    function rec1(){
        $novel = Book::all();
        return view('user.rec1', compact('novel'));
    }
}
