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


class AdminController extends Controller
{
    //
    function Login(){
        return view("admin.login");
    }

    function VerifyLogin(Request $request){
        $user = Admin::where("admin_username",$request->input("username"))->first();
        $password = $request->input("password");

        if(!($user && Hash::check($password,$user->admin_password))){
            return redirect()->route("admin.login");
        }

        Session::flush();
        Session::put("admin_user",$user);

        return redirect()->route("admin.index");

    }

    function Index(){
        return view('admin.index');
    }

    function SignOut(){
        Session::flush();

        return redirect()->route("admin.login");
    }

    function Home(){
        $user = Userdb::all();
        $userCount = $user->count();
        $comic = Book::where('bookTypeID',2)->get();
        $comicCount = $comic->count();
        $novel = Book::where('bookTypeID',1)->get();
        $novelCount = $novel->count();

        return view("admin.dashboard",compact('user','userCount','comicCount','novelCount'));
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
}
