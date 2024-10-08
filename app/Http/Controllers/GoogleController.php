<?php

namespace App\Http\Controllers;

use App\Models\Userdb;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function Redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function CallbackGoogle(){
        try{
            $google_user = Socialite::driver('google')->user();

            $intended = null;
            if (Session::has('url.intended')) {
                $intended = Session::get('url.intended');
            }

            $user = DB::table("userdbs")->where("email",$google_user->getEmail())->first();
            if(!$user){

                Session::flush();
                Session::put("google_email",$google_user->getEmail());
                Session::put("google_avatar",$google_user->getAvatar());

                $data = [
                    "username" => $google_user->getEmail(),
                    "profile" => $google_user->getAvatar(),
                    "name" => $google_user->getName(),
                    "email" => $google_user->getEmail(),
                    "gender" => "N",
                    "created_at" => now()
                ];

                Userdb::insert($data);

                $user = DB::table("userdbs")->where("email",$google_user->getEmail())->first();
                Session::flush();
                Session::put("user", $user);

               if($intended){
                    return redirect($intended);
               }

                return redirect()->route("index");
            }
            Session::flush();
            Session::put("user",$user);

            if ($intended) {
                return redirect($intended);
            }
            

            return redirect()->route('index');
        }catch(\Throwable $th){
            return redirect()->route('sign_in')->withErrors(["msg"=> "เข้าสู่ระบบล้มเหลว โปรดลองอีกครั้ง"]);
        }
    }
}
