<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Book_type;
use App\Models\Book_chapter;
use Illuminate\Http\Request;

class ReadController extends Controller
{
    public function read($bookID){
        $books = Book::where("BookID", $bookID)->get();
        $chapters = Book_chapter::where("bookID", $bookID)
                    ->where("chapter_status", 'public') ->get();
        $count_chapter = Book_chapter::where("bookID", $bookID)->count();
        dd($chapters);
        return view("user.read_novel", compact('books', 'bookID','chapters','count_chapter'));
    }
    
    public function readnovel_chapt($bookID,$chapterID){
        $books = Book::where("BookID",$bookID)->first();
        $chapters = Book_chapter::where("chapterID",$chapterID)->where("bookID",$bookID)->first();
        dd($chapters);
        return view('user.read_novel_chapter',compact("chapters","bookID","chapterID","books"));
    } 

}
