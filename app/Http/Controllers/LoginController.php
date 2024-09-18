<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Userdb;

class LoginController extends Controller
{
    //

    function verify(Request $request){
        $user = DB::table("userdbs")->where("username",$request->input("username"))->first();
        $password = $request->input("password");

        if(!($user && Hash::check($password,$user->password))){
            return redirect()->back()->withErrors(["msg" => "Invalid username or password."]);
        }

        Session::flush();
        Session::put("user",$user);
        
        return redirect()->route("index");
    }

    function insert(Request $request){
        $request->validate([
            "username" => "unique:userdbs,username",
            "email" => "unique:userdbs,email",
            "password" => "min:8",
            "confirm" => "same:password"
        ],[
            "username.unique" => "ชื่อผู้ใช้ถูกใช้งานแล้ว",
            "email.unique" => "อีเมลล์ถูกใช้งานแล้ว",
            "password.min" => "รหัสผ่านต้องมีขั้นต่ำ 8 ตัวอักษร",
            "confirm.same" => "รหัสผ่านไม่ตรงกัน"
        ]);

        $insert = [
            "username" =>  $request->input("username") , 
            "name" => $request->input("username"),
            "email" => $request->input("email") , 
            "password" => Hash::make($request->input("password")) ,
            "gender" => $request->input("gender") , 
            "created_at" => now() ,
        ];


        DB::table("userdbs")->insert($insert);

        $user = Userdb::where("username",$request->input("username"))->first();
        Session::flush();
        Session::put("user",$user);

        return redirect()->route("index");
    }

    function logout(){
        Session::flush();
        return redirect()->route('sign_in');
    }
}
