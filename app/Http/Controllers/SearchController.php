<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Userdb;
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
            ->orWhereHas('User', function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
            ->orWhereHas('Genre', function ($q) use ($query) {
                $q->where('bookGenre_name', 'LIKE', "%{$query}%");
            })
            ->orWhereHas('Type', function ($q) use ($query) {
                $q->where('bookType_name', 'LIKE', "%{$query}%");
            })
            ->get();
        // ส่งผลลัพธ์การค้นหาไปที่ view
        return view('user.search-result', compact('books', 'query'));
    }


    public function searchAdmin(Request $request)
    {
        $query = $request->input('query');

        $books = Book::where('bookTypeID', 1) // ตรวจสอบ bookTypeID ก่อน
            ->where('book_status', 'public') // เงื่อนไขสำหรับ book_status
            ->where(function ($q) use ($query) {
                // เงื่อนไขการค้นหาทั้งหมดภายใต้ where หลัก
                $q->where('book_name', 'LIKE', "%{$query}%")
                    ->orWhere('book_description', 'LIKE', "%{$query}%")
                    ->orWhereHas('User', function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%");
                })
                    ->orWhereHas('Genre', function ($q) use ($query) {
                    $q->where('bookGenre_name', 'LIKE', "%{$query}%");
                })
                    ->orWhereHas('Type', function ($q) use ($query) {
                    $q->where('bookType_name', 'LIKE', "%{$query}%");
                });
            })
            ->paginate(20);

        return view('admin.search_admin', compact('books', 'query'));
    }

    public function searchAdmincomic(Request $request)
    {
        $query = $request->input('query');

        $books = Book::where('bookTypeID', 2) // ตรวจสอบ bookTypeID ก่อน
            ->where('book_status', 'public') // เงื่อนไขสำหรับ book_status
            ->where(function ($q) use ($query) {
                // เงื่อนไขการค้นหาทั้งหมดภายใต้ where หลัก
                $q->where('book_name', 'LIKE', "%{$query}%")
                    ->orWhere('book_description', 'LIKE', "%{$query}%")
                    ->orWhereHas('User', function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%");
                })
                    ->orWhereHas('Genre', function ($q) use ($query) {
                    $q->where('bookGenre_name', 'LIKE', "%{$query}%");
                })
                    ->orWhereHas('Type', function ($q) use ($query) {
                    $q->where('bookType_name', 'LIKE', "%{$query}%");
                });
            })
            ->paginate(20);


        return view('admin.searchcomic_admin', compact('books', 'query'));
    }
    function searchAdminUser()
    {
        $query = '';
        $user = Userdb::all();
        return view('admin.searchUser' ,compact('user','query'));
    }

    function searchUser(Request $request)
    {

        $query = $request->input('query');

        if ($query) {
            // ค้นหาหนังสือจากฐานข้อมูล
            $user = Userdb::where('name', 'LIKE', "%{$query}%")->get();
        } else {
            $user = null; // หรือเป็น Collection ว่างก็ได้ เช่น collect([]);
        }
        // ส่งผลลัพธ์การค้นหาไปที่ view
        return view('admin.searchUser', compact('user', 'query'));
    }
}
