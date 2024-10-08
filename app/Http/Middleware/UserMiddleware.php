<?php

namespace App\Http\Middleware;

use App\Models\Userdb;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        if(Session::has("user")){
            $user = Userdb::where("username",Session::get("user")->username)->first();
            if(!$user){
                Session::flush();
                return redirect()->route("sign_in");
            }
            return $next($request);
        }

        Session::put('url.intended', $request->fullUrl());
        return redirect()->route("sign_in");
    }
}
