<?php

namespace App\Http\Controllers;

use App\Models\Userdb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    //
    public function Redirect()
    {
        return Socialite::driver("facebook")->stateless()->redirect();
    }

    public function CallbackFacebook()
    {
        try {
            $facebook_user = Socialite::driver("facebook")->stateless()->user();
            $intended = null;
            if (Session::has('url.intended')) {
                $intended = Session::get('url.intended');
            }

            $user = Userdb::where("username",$facebook_user->getEmail())->first();
            if(!$user){
                Session::flush();

                $data = [
                    "username" => $facebook_user->getEmail(),
                    "profile" => $facebook_user->getAvatar(),
                    "name" => $facebook_user->getName(),
                    "email" => $facebook_user->getEmail(),
                    "gender" => "N",
                    "created_at" => now()
                ];

                Userdb::insert($data);
                $user = DB::table("userdbs")->where("email", $facebook_user->getEmail())->first();
                Session::flush();
                Session::put("user", $user);

                if ($intended) {
                    return redirect($intended);
                }

                return redirect()->route("index");
            }

            Session::flush();
            Session::put("user", $user);

            if ($intended) {
                return redirect($intended);
            }


            return redirect()->route('index');
        } catch (\Throwable $th) {
            return redirect()->route('sign_in')->withErrors(["msg"=>"Login failed. Please try again."]);
        }
    }

}
