<?php

namespace App\Http\Middleware;

use App\Models\Book;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class OwnerBookMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try{
            $bookID = $request->route("bookID");
            $book = Book::where("username",Session::get("user")->username)->where("bookID",$bookID)->first();
            if(isset($book) && $book){
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
