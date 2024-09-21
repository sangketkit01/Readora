<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Book_type;
use App\Models\Book_chapter;
use Illuminate\Http\Request;

class ReadController extends Controller
{
    public function read_novel($bookID){
        $books = Book::where("BookID", $bookID)->get();
        $chapters = Book_chapter::where("bookID", $bookID)->get();
        $count_chapter = Book_chapter::where("bookID", $bookID)->count();
        return view("user.read_book", compact('books', 'bookID','chapters','count_chapter'));
    } 
}
