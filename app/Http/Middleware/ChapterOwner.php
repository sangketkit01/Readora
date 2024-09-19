<?php

namespace App\Http\Middleware;

use App\Models\Book_chapter;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChapterOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $chapter = Book_chapter::where('bookID',$request->route('bookID'))->where('chapterID',$request->route('chapterID'));
        if(!$chapter){
            return redirect()->route("index");
        }
        return $next($request);
    }
}
