<?php

namespace App\Http\Middleware;

use App\Models\Novel;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class OwnerNovelMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try{
            $novelID = $request->route("novelID");
            $novel = Novel::where("username",Session::get("user")->username)->where("novelID",$novelID)->first();
            if(isset($novel) && $novel){
                return $next($request);
            }else{
                return abort(404);
            }
        }catch(\Exception $e){
            return abort(404);
        }
        
        return redirect()->route('index');
    }
}
