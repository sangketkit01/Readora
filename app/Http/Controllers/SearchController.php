<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function search(Request $request)
    {
        $query = $request->input('query');

        // ค้นหาหนังสือจากฐานข้อมูล
        $books = Book::where('book_name', 'LIKE', "%{$query}%")
                    ->orWhere('book_description', 'LIKE', "%{$query}%")
                    ->orWhereHas('User', function($q) use ($query){
                        $q->where('name','LIKE',"%{$query}%");
                    })
                    ->orWhereHas('Genre', function($q) use ($query){
                        $q->where('bookGenre_name','LIKE',"%{$query}%");
                    })
                    ->orWhereHas('Type', function($q) use ($query){
                        $q->where('bookType_name','LIKE',"%{$query}%");
                    })
                    ->get();
        // ส่งผลลัพธ์การค้นหาไปที่ view
        return view('user.search-result', compact('books', 'query'));
    }

    public function searchAdmin(Request $request)
    {
        $query = $request->input('query');

        // ค้นหาหนังสือจากฐานข้อมูล
        $books = Book::where('book_name', 'LIKE', "%{$query}%")
            ->orWhere('book_description', 'LIKE', "%{$query}%")
            ->where('username', 'LIKE', "%{$query}%")
            ->get();
        // ส่งผลลัพธ์การค้นหาไปที่ view
        return view('admin.search_admin', compact('books', 'query'));
    }
}

