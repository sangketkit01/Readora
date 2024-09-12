<?php

namespace App\Http\Controllers;
use App\Models\Userdb;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function forgot(){
        return view('security.forgot');
    }

    public function password(Request $request){
        $request->validate([
            'email' => 'required|email|exists:userdbs',
        ]);
        
        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send("Mail.forgot_password",['token' => $token], function($message) use ($request){
            $message->to($request->email);
            $message->subject("Reset Password");
            
        });

        return redirect()->to(route('forgot.password'))
            ->with("success", "We have send an email to reset password.");
    }

    function resetPassword($token){
        return view('new-password', compact('token'));
    }

    function resetPasswordPost(Request $request){
        $request->validate([
            "email" => "required|email|exists:userdbs",
            "password" => "required|string|min:8|confirmed",
            "password_confirm" => "required"
        ]);

        $updatePassword = DB::table('password_resets')
            ->where([
                "email" => $request->email,
                "token" => $request->token
            ])->first();
        
            if(!$updatePassword){
                return redirect()->to(route("reset_password"))->with("error", "invalid");
            }

            Userdb::where("email",$request->email)
                ->update(["password" => Hash::make($request->password)]);

            DB::table("password_resets")->where(["email" => $request->email])->delete();
            return redirect()->to(route("signin"))->with("success", "Password reset success.");
    }
}
