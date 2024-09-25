<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Book_type;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $novels = Book::where('BooktypeID', 1)->where('book_status', 'public')->take(4)->get();
        $comics = Book::where('BooktypeID', 2)->where('book_status', 'public')->take(4)->get();
        $romanticNovels = Book::where('BooktypeID', 1)
            ->where('BookgenreID', 1)
            ->limit(4)
            ->get();

        return view("user.index", compact("novels", 'romanticNovels', 'comics'));

    }

    public function rec1()
    {

        $novels = Book::where('BooktypeID', 1)->where('book_status', 'public')->get();
        return view("user.rec1", compact('novels'));
    }

    public function rec2()
    {

        $comics = Book::where('BooktypeID', 2)->where('book_status', 'public')->get();

        return view("user.rec2", compact('comics'));

    }


    function book_shelve()
    {
        $novels = Book::where('BooktypeID', 1)->where('book_status', 'public')->get();
        return view("user.book_shelve", compact('novels'));
    }

    public function book_shelve_commic()
    {
        $comics = Book::where('BooktypeID', 2)->where('book_status', 'public')->get();
        return view("user.book_shelve_commic", compact('comics'));

    }

}
