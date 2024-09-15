<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userdb;
use App\Models\Book;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Rules\MatchOldPassword;

class UserController extends Controller
{
    //
    function profile(){
        $info = Userdb::where('username', Session::get('user')->username)->get();
        // dd(Session::get('user')->username);
        $book = Book::all();
        return view('user.profile', compact('info'));
    }

    function update_info(Request $request){
        $request->validate([
            'name' => 'required|string|max:60',
            'email' => 'required|email|max:255',
            'gender' => 'required|string|max:4',
        ]);
        $user = Userdb::where('username', Session::get('user')->username)->first();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->gender = $request->input('gender');
        $user->save();
        return redirect()->route('profile');
    }

    public function add_password(Request $request) {
        $request->validate([
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ], [
            'new_password.min' => 'รหัสผ่านต้องมีอย่างน้อย 8 ตัวอักษร',
            'confirm_password.same' => 'รหัสผ่านไม่ตรงกัน',
        ]);
        $user = Userdb::where('username', Session::get('user')->username)->first();
        // $user->password = Hash::make($request->input('new_password'));
        $user->password = $request->input('new_password');
        $user->save();
        return redirect()->route('profile')->with('success', 'รหัสผ่านถูกเปลี่ยนเรียบร้อย');
    }
    

    function update_password(Request $request){
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => 'required|min:8|confirmed',
        ]);
        $user = Userdb::where('username', Session::get('user')->username)->first();
        $user->password = Hash::make($request->new_password);
        $user->save();
        return redirect()->route('profile')->with('success', 'เปลี่ยนรหัสผ่านเรียบร้อยแล้ว');
    }
    
    function rec1(){
        $book = Book::all();
        return view('user.rec1', compact('book'));
    }
}
