<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    //
    function Login(){
        return view("admin.login");
    }

    function VerifyLogin(Request $request){
        $user = Admin::where("admin_username",$request->input("username"))->first();
        $password = $request->input("password");

        if(!($user && Hash::check($password,$user->admin_password))){
            return redirect()->route("admin.login");
        }

        Session::flush();
        Session::put("admin_user",$user);

        return redirect()->route("admin.index");

    }

    function Index(){
        return view('admin.index');
    }

    function SignOut(){
        Session::flush();

        return redirect()->route("admin.login");
    }
}
