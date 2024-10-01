<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Book_type;
use App\Models\Book_genre;
use App\Models\Bookshelf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    public function index()
    {
        $novels = Book::where('BooktypeID', 1)
            ->where('book_status', 'public')
            ->whereHas('User', function ($query) {
                $query->whereNull('deleted_at'); // กรองเฉพาะผู้แต่งที่ไม่ถูกลบ (soft deleted)
            })
            ->take(4)
            ->get();

        $comics = Book::where('BooktypeID', 2)
            ->where('book_status', 'public')
            ->whereHas('User', function ($query) {
                $query->whereNull('deleted_at'); 
            })
            ->take(4)
            ->get();

        $genres = Book_genre::all();

        $romanticNovels = Book::where('BooktypeID', 1)
            ->where('BookgenreID', 1)
            ->where('book_status', 'public')
            ->whereHas('User', function ($query) {
                $query->whereNull('deleted_at');
            })
            ->limit(4)
            ->get();

        return view("user.index", compact("novels", 'romanticNovels', 'comics', 'genres'));
    }


    public function rec1()
    {

        $novels = Book::where('BooktypeID', 1)
            ->where('book_status', 'public')
            ->orderBy('click_count', 'DESC')
            ->get();
        return view("user.rec1", compact('novels'));
    }

    public function rec2()
    {

        $comics = Book::where('BooktypeID', 2)
            ->where('book_status', 'public')
            ->orderBy('click_count', 'DESC')
            ->get();

        return view("user.rec2", compact('comics'));
    }


    public function book_shelve()
    {
        
        $novels = Bookshelf::with('book')
            ->whereHas('User', function ($query) {
                $query->whereNull('deleted_at');
            }) 
            ->whereHas('book', function ($query) {
                $query->where('BooktypeID', 1);
            }) 
            ->orderBy('created_at', 'desc')
            ->get();

        return view("user.book_shelve", compact('novels'));
    }

    public function book_shelve_commic()
    {
        $comics = Bookshelf::with('book')
            ->whereHas('User', function ($query) {
                $query->whereNull('deleted_at');
            })
            ->whereHas('book', function ($query) {
                $query->where('BooktypeID', 2);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view("user.book_shelve_commic", compact('comics'));
    }


    public function Genre($genreID)
    {
        $genre = Book_genre::where('bookGenreID', $genreID)->first();

        // ตรวจสอบว่า $genre ถูกดึงมาหรือไม่
        if (!$genre) {
            // ถ้าไม่มีข้อมูล ให้แสดงหน้าข้อผิดพลาดหรือ redirect
            abort(404, 'Genre not found.');
        }

        $books = Book::where('bookGenreID', $genre->bookGenreID)->get();

        return view('user.genre', compact('genre', 'books'));
    }
}
