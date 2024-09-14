<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userdb;
use App\Models\Book;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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

    function add_password(Request $request){
        $request->validate([
            'new_password' => 'required|min:8|confirmed',
            'confirm_password' => 'required',
        ]);
        $user = Userdb::where('username', Session::get('user')->username)->first();
        $user->password = $request->input('confirm_password');
        $user->save();
        return redirect()->route('profile');
    }

    function update_password(Request $request){
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, Session::get('user')->password)) {
            return back()->withErrors(['current_password' => 'รหัสผ่านเดิมไม่ถูกต้อง']);
        }
        $user = Session::get('user');
        $user->password = Hash::make($request->new_password);
        $user->save();
        return back()->with('success', 'เปลี่ยนรหัสผ่านเรียบร้อยแล้ว');

    }
    
    

    function rec1(){
        $book = Book::all();
        return view('user.rec1', compact('book'));
    }
}
