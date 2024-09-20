<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userdb;
use App\Models\Novel;
use App\Models\Comic;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    function profile(){
        $user = Userdb::where('username', Session::get('user')->username)->first();
        // dd(Session::get('user')->username);
        return view('profile.main', compact('user'));
    }

    function edit_info(Request $request){
        $user = Userdb::where('username', Session::get('user')->username)->first();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->gender = $request->input('gender');
        $user->save();
        return redirect()->route('profile');
    }
    function editInfoPage($username){
        $user = Userdb::where('username', Session::get('user')->username)->first();
        return view('profile.main', compact('user', 'username'));
    }

    function novelInfoPage($username){
        $user = Userdb::where('username', Session::get('user')->username)->first();
        $novel = Novel::where('username', $user->username)->get();
        $c_count = Novel::where('username', $user->username)->count();
        return view('profile.main', compact('user', 'novel', 'username'));
    }

    function comicInfoPage($username){
        $user = Userdb::where('username', Session::get('user')->username)->first();
        $comic = Comic::where('username', $user->username)->get();
        $n_count = Comic::where('username', $user->username)->count();
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
            return redirect()->back()->withErrors(['current_password' => 'รหัสผ่านเดิมไม่ถูกต้อง']);
        }
        $user->password = Hash::make($request->input("password"));
        $user->save();
        return redirect()->route('profile');
    }
    
    function rec1(){
        $novel = Novel::all();
        return view('user.rec1', compact('novel'));
    }
}
