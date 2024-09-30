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

        return redirect()->route("Home_admin");
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


    function Checkreport()
    {
        $reports = Report::all();

        return view('admin.checkreport_admin', compact('reports'));
    }
    public function book_detail($bookID)
    {
        $books = Book::where('BookID', $bookID)
            ->get();
        if ($books->isEmpty()) {
            abort(404, 'Book not found');
        }
        $reports = Report::join('userdbs','reports.username','userdbs.username')
            ->where('bookID', $bookID)
            ->get();
        return view("admin.book_detail", compact('books', 'bookID', 'reports'));
    }
    public function block($bookID)
    {
        $book = Book::find($bookID);

        if ($book) {
            // เปลี่ยนค่า book_status เป็น 'block'
            $book->book_status = 'block';
            $book->save();

            return redirect()->back()->with('success', 'Book has been blocked successfully.');
        } else {
            return redirect()->back()->with('error', 'Book not found.');
        }
    }

    public function unblock($bookID)
    {
        $book = Book::find($bookID);

        if ($book) {
            // เปลี่ยนค่า book_status กลับเป็น 'public'
            $book->book_status = 'public'; // หรือ 'private' ตามที่คุณต้องการ
            $book->save();

            return redirect()->back()->with('success', 'Book has been unblocked successfully.');
        } else {
            return redirect()->back()->with('error', 'Book not found.');
        }
    }
    public function viewBlockedBooks()
    {
        // Query ข้อมูลหนังสือที่ถูกบล็อก
        $books = Book::where('book_status', 'block')
        ->where('bookTypeID','1')->get();

        // ส่งข้อมูลไปที่ view
        return view('admin.block_book', compact('books'));
    }
    public function viewBlockedComic()
    {
        // Query ข้อมูลหนังสือที่ถูกบล็อก
        $books = Book::where('book_status', 'block')
        ->where('bookTypeID','2')->get();

        // ส่งข้อมูลไปที่ view
        return view('admin.block_commic', compact('books'));
    }
    public function unblockBook($bookID)
    {
        // หา book ตาม ID และเปลี่ยนสถานะ
        $book = Book::findOrFail($bookID);
        $book->book_status = 'active';
        $book->save();

        return redirect()->route('admin.block_book')->with('success', 'หนังสือถูกปลดบล็อกแล้ว');
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
