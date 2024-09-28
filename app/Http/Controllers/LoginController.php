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

    function Verify(Request $request){
        $intended = null;
        if (Session::has('url.intended')) {
            $intended = Session::get('url.intended');
        }

        try{
            $user = DB::table("userdbs")->where("username", $request->username)->first();
            $password = $request->password;

            if (!($user && Hash::check($password, $user->password))) {
                return redirect()->back()->withErrors(["msg" => "Invalid username or password."])->withInput();;
            }

            Session::flush();
            Session::put("user", $user);
        }catch(\Throwable $th){
            return redirect()->route('sign_in')->withErrors(["msg" => "Login failed. Please try again."]);
        }

        if ($intended) {
            return redirect($intended);
        }

        return redirect()->route("index");
    }

    function Insert(Request $request){
        $intended = null;
        if (Session::has('url.intended')) {
            $intended = Session::get('url.intended');
        }


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
            "username" =>  $request->username , 
            "name" => $request->username,
            "profile" => "novel/midoriya.png",
            "email" => $request->email , 
            "password" => Hash::make($request->password) ,
            "gender" => $request->gender , 
            "created_at" => now() ,
        ];


        DB::table("userdbs")->insert($insert);

        $user = Userdb::where("username",$request->username)->first();
        Session::flush();
        Session::put("user",$user);

        if($intended){
            return redirect($intended);
        }

        return redirect()->route("index");
    }

    function Logout(){
        Session::flush();
        return redirect()->route('sign_in');
    }
}
