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
                $query->whereNull('deleted_at'); //เฉพาะผู้แต่งที่ไม่ถูกลบ (soft deleted)
            })
            ->with(['Chapters' => function($query) {$query->where('chapter_status', 'public')->whereNull('deleted_at')->withCount('Comments');}])
            ->orderBy('created_at', 'DESC')
            ->take(4)
            ->get();

        $comics = Book::where('BooktypeID', 2)
            ->where('book_status', 'public')
            ->whereHas('User', function ($query) {
                $query->whereNull('deleted_at'); 
            })
            ->with(['Chapters' => function($query) {$query->where('chapter_status', 'public')->whereNull('deleted_at')->withCount('Comments');}])
            ->orderBy('created_at', 'DESC')
            ->take(4)
            ->get();

        $genres = Book_genre::all();

        $romanticNovels = Book::where('BooktypeID', 1)
            ->where('BookgenreID', 1)
            ->where('book_status', 'public')
            ->whereHas('User', function ($query) {
                $query->whereNull('deleted_at');
            })
            ->with(['Chapters' => function($query) {$query->where('chapter_status', 'public')->whereNull('deleted_at')->withCount('Comments');}])
            ->orderBy('created_at', 'DESC')
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
        $username = Session::get('user');

        if (is_object($username)) {
            $username = $username->username; // กรณีเป็น object
        } elseif (is_array($username)) {
            $username = $username['username']; // กรณีเป็น array
        }

        $novels = Bookshelf::with('book')
            ->where('username', $username)
            ->whereHas('book', function ($query) {
                $query->where('BooktypeID', 1);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view("user.book_shelve", compact('novels'));
    }

    public function book_shelve_commic()
    {
        $username = Session::get('user');

        if (is_object($username)) {
            $username = $username->username; // กรณีเป็น object
        } elseif (is_array($username)) {
            $username = $username['username']; // กรณีเป็น array
        }

        $comics = Bookshelf::with('book')
            ->where('username', $username)
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
