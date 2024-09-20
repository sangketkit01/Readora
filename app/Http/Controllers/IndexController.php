<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Book_type;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $books = Book::take(4)->get();
        $romanticBooks = Book::where('bookTypeID', 1)->limit(4)->get();
        return view("user.index", compact("books", 'romanticBooks'));
    }

    public function rec1()
    {
        $book = Book::all();
        return view("user.rec1", compact('book'));
    }

    public function rec2()
    {
        $book = Book::all();
        return view("user.rec2", compact('book'));
    }

}
