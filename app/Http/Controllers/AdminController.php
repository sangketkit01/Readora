<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Report;
use App\Models\Book_chapter;
use App\Models\Chapter_comment;
use App\Models\Userdb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Book;

use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    //
    function Login()
    {
        return view("admin.login");
    }

    function VerifyLogin(Request $request)
    {
        $user = Admin::where("admin_username", $request->input("username"))->first();
        $password = $request->input("password");

        if (!($user && Hash::check($password, $user->admin_password))) {
            return redirect()->route("admin.login");
        }

        Session::flush();
        Session::put("admin_user", $user);

        return redirect()->route("admin.index");
    }

    function Index()
    {
        return view('admin.index');
    }

    function SignOut()
    {
        Session::flush();

        return redirect()->route("admin.login");
    }

    function Home()
    {
        $user = Userdb::all();
        $userCount = $user->count();
        $comic = Book::where('bookTypeID', 2)->get();
        $comicCount = $comic->count();
        $novel = Book::where('bookTypeID', 1)->get();
        $novelCount = $novel->count();

        return view("admin.dashboard", compact('user', 'userCount', 'comicCount', 'novelCount'));
    }


    function Checkreport(){
        $reports = Report::all();

        return view('admin.checkreport_admin',compact('reports'));
    }
    public function novel_detail($bookID)
    {
        $books = Book::where('BookID', $bookID)
            ->where('book_status', 'public')
            ->where('booktypeID', 1)
            ->get();
        if ($books->isEmpty()) {
            abort(404, 'Book not found');
        }
        $chapters = Book_chapter::where("bookID", $bookID)
            ->where("chapter_status", 'public')->get();
        $chapterComments = [];
        foreach ($chapters as $chapter) {
            $comments = Chapter_comment::where('chapterID', $chapter->chapterID)
                ->with('user')
                ->get();
            $chapterComments[$chapter->chapterID] = $comments;
        }
        $count_chapter = Book_chapter::where("bookID", $bookID)
            ->where("chapter_status", 'public')
            ->count();
        $count_comment = Chapter_comment::whereIn('chapterID', function ($query) use ($bookID) {
            $query->select('chapterID')
                ->from('book_chapters')
                ->where('bookID', $bookID);
        })->count();
        return view("admin.novel_detail", compact('books', 'bookID', 'chapters', 'count_chapter', 'chapterComments', 'count_comment'));
    }

    function adminDeleteUser(Request $request)
    {
        // ตรวจสอบว่ามี username ส่งมาหรือไม่
        if (!$request->has('username')) {
            return redirect()->back()->with('error', 'Username is required.');
        }

        $username = $request->username;

        // ค้นหาผู้ใช้จาก username
        $user = Userdb::where('username', $username)->first();

        // ตรวจสอบว่าพบผู้ใช้หรือไม่
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }
        // ลบผู้ใช้
        $user->delete();
        // ส่งกลับไปยังหน้าก่อนหน้าพร้อมข้อความสำเร็จ
        return redirect()->back()->with('success', 'User deleted successfully.');
    }
    function adminRestoreUser(Request $request)
    {
        if (!$request->has('username')) {
            return redirect()->back()->with('error', 'Username is required.');
        }

        $username = $request->username;

        // ค้นหาผู้ใช้ที่ถูกลบแล้วจาก username
        $user = Userdb::withTrashed()->where('username', $username)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // กู้คืนผู้ใช้
        $user->restore();

        return redirect()->back()->with('success', 'User restored successfully.');
    }
    function deletedUsers(Request $request)
    {
        $query = $request->input('query');

        $deletedUsers = Userdb::onlyTrashed()
            ->when($query, function ($q) use ($query) {
                return $q->where('name', 'LIKE', "%{$query}%")
                    ->orWhere('username', 'LIKE', "%{$query}%")
                    ->whereNotNull('deleted_at');
            })
            ->get();

        return view('admin.restore', compact('deletedUsers', 'query'));
    }

    
}
