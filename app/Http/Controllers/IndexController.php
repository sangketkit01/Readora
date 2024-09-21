<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Novel_type;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $novels = Book::take(4)->get();
        return view("user.index", compact("novels"));
    }
    public function rec1()
    {
        $novel = Book::all();
        return view("user.rec1", compact('novel'));
    }

    public function rec2()
    {
        $novel = Book::all();
        return view("user.rec2", compact('novel'));
    }

}
