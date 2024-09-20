<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userdb;
use App\Models\Novel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Rules\MatchOldPassword;

class UserController extends Controller
{
    //
    function profile(){
        $info = Userdb::where('username', Session::get('user')->username)->first();
        // dd(Session::get('user')->username);
        $novel = Novel::all();
        return view('profile.main_profile', compact('info'));
    }

    function update_info(Request $request){
        $user = Userdb::where('username', Session::get('user')->username)->first();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->gender = $request->input('gender');
        $user->save();
        return redirect()->route('profile');
    }

    public function callView(){
        return view('profile.create_password');
    }
    public function create_password(Request $request) {
        dd($request->all());
        $request->validate([
            'new_password' => 'required|min:8|confirmed',
        ], 
        [
            'new_password.required' => 'กรุณากรอกรหัสผ่านใหม่',
            'new_password.min' => 'รหัสผ่านต้องมีอย่างน้อย 8 ตัวอักษร',
            'new_password.confirmed' => 'การยืนยันรหัสผ่านไม่ตรงกัน',
        ]);
        $user = Userdb::where('username', Session::get('user')->username)->first();
        $user->password = Hash::make($request->input('new_password'));
        $user->save();
        return redirect()->route('profile')->with('success', 'สร้างรหัสผ่านเรียบร้อยแล้ว');
    }
    
    public function callView2(){
        return view('profile.change_password');
    }
    
    function update_password(Request $request){
    }
    
    function rec1(){
        $novel = Novel::all();
        return view('user.rec1', compact('novel'));
    }
}
