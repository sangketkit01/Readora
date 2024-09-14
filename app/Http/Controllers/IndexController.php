<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $books = Book::all();
        return view("user.index",compact("books"));
    }
    function rec1()
    {
        $book = Book::all();
        return view('user.rec1', compact('book'));
    }
}
