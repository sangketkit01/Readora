<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle(){
        try{
            $google_user = Socialite::driver('google')->user();

            $user = DB::table("userdbs")->where("email",$google_user->getEmail())->first();
            if(!$user){
                Session::flush();
                Session::put("google_email",$google_user->getEmail());
                Session::put("google_avatar",$google_user->getAvatar());

                return redirect()->route('sign_up');
            }
            Session::flush();
            Session::put("user",$user);

            $data = [
                "avatar" => $google_user->getAvatar() , 
                "name" => $google_user->getName(),
                "username" => $google_user->getEmail()
            ];

            Session::put("data",$data);

            return redirect()->route('index');
        }catch(\Throwable $th){
            return redirect()->route('sign_in')->withErrors(["msg"=>"Login failed. Please try again."]);
        }
    }
}
