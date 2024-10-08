<?php

namespace App\Http\Controllers;
use App\Models\click;

use App\Models\Book;
use App\Models\Bookshelf;
use App\Models\Book_type;
use App\Models\Book_chapter;
use App\Models\Chapter_comment;
use App\Models\Report;
use App\Models\Userdb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class ReadController extends Controller
{
    public function read_novel($bookID)
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
        $shelve = Bookshelf::where("username",Session::get("user")->username)->where("bookID",$bookID)->first();

        return view("user.read_novel", compact('books', 'bookID', 'chapters', 'count_chapter', 'chapterComments', 'count_comment',"shelve"));
    }

    public function readnovel_chapt($bookID, $chapterID)
    {
        $user = Userdb::where('username', Session::get('user')->username)->first();
        $books = Book::where("BookID", $bookID)->first();
        $chapters = Book_chapter::where("chapterID", $chapterID)->where("bookID", $bookID)->first();
        $previousChapter = Book_chapter::where('bookID', $bookID)
            ->where('chapterID', '<', $chapterID)
            ->orderBy('chapterID', 'desc')
            ->first();
        $nextChapter = Book_chapter::where('bookID', $bookID)
            ->where('chapterID', '>', $chapterID)
            ->orderBy('chapterID', 'asc')
            ->first();

        $chapterComments = Chapter_comment::where('chapterID', $chapterID)
            ->with('user')
            ->get();

        $commentCount = $chapterComments->count();

        return view('user.read_novel_chapter', compact('user', "chapters", "chapterID", "books", 'previousChapter', 'nextChapter', 'chapterComments', 'commentCount'));
    }

    public function readFirstChapterNovel($bookID)
    {
        $book = Book::where("BookID", $bookID)->first();
        $firstChapter = Book_chapter::where("bookID", $bookID)
            ->where('chapter_status', 'public')
            ->orderBy('chapterID', 'asc')
            ->first();
        if ($firstChapter) {
            return redirect()->route('read.read_chaptnovel', [
                'bookID' => $bookID,
                'chapterID' => $firstChapter->chapterID
            ]);
        } else {
            return redirect()->route('read.read_novel', ['bookID' => $bookID]);
        }
    }

    public function read_comic($bookID)
    {
        $books = Book::where('BookID', $bookID)
            ->where('book_status', 'public')
            ->where('booktypeID', 2)
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
        $shelve = Bookshelf::where("username", Session::get("user")->username)->where("bookID", $bookID)->first();

        return view("user.read_comic", compact('books', 'bookID', 'chapters', 'count_chapter', 'chapterComments', 'count_comment','shelve'));
    }

    public function readcomic_chapt($bookID, $chapterID)
    {
        $user = Userdb::where('username', Session::get('user')->username)->first();
        $books = Book::where("BookID", $bookID)->first();
        $chapters = Book_chapter::where("chapterID", $chapterID)->where("bookID", $bookID)->first();
        $pdfPath = $chapters ? $chapters->pdf_path : null;
        $previousChapter = Book_chapter::where('bookID', $bookID)
            ->where('chapterID', '<', $chapterID)
            ->orderBy('chapterID', 'desc')
            ->first();
        $nextChapter = Book_chapter::where('bookID', $bookID)
            ->where('chapterID', '>', $chapterID)
            ->orderBy('chapterID', 'asc')
            ->first();

        $chapterComments = Chapter_comment::where('chapterID', $chapterID)
            ->with('user')
            ->get();

        $commentCount = $chapterComments->count();

        return view('user.read_comic_chapter', compact('user', "chapters", "chapterID", "books", 'previousChapter', 'nextChapter', 'chapterComments', 'commentCount'));
    }
    public function readFirstChapterComic($bookID)
    {
        $book = Book::where("BookID", $bookID)->first();
        $firstChapter = Book_chapter::where("bookID", $bookID)
            ->where('chapter_status', 'public')
            ->orderBy('chapterID', 'asc')
            ->first();
        if ($firstChapter) {
            return redirect()->route('read.read_chaptcomic', [
                'bookID' => $bookID,
                'chapterID' => $firstChapter->chapterID
            ]);
        } else {
            return redirect()->route('read.read_comic', ['bookID' => $bookID]);
        }
    }
    public function submitReport(Request $request)
    {
        $request->validate([
            'bookID' => 'required|integer',
            'report_message' => 'required|string',
        ]);
        Report::create([
            'bookID' => $request->input('bookID'),
            'username' => $request->input('username'),
            'report_message' => $request->input('report_message'),
            'report_status' => 'unread',
        ]);

        return back()->with('success', 'รายงานนิยายเรียบร้อยแล้ว');
    }

    public function incrementClickAndRedirect($bookID)
    {
        // ค้นหานิยายตาม ID
        $novel = Book::find($bookID);
        // เพิ่มค่า click_count ถ้านิยายถูกพบ
        if ($novel) {
            $novel->increment('click_count');
        }
        // ส่งข้อมูลไปยังหน้าอ่านนิยายและส่งข้อมูลทั้งหมดไปด้วย
        return redirect()->route('read.read_novel', ['bookID' => $bookID])
            ->with(['novel' => $novel]);
    }

    public function incrementClickAndRedirectComic($bookID)
    {
        // ค้นหาการ์ตูนตาม ID
        $comic = Book::find($bookID);
        // เพิ่มค่า click_count ถ้าการ์ตูนถูกพบ
        if ($comic) {
            $comic->increment('click_count');
        }
        // ส่งข้อมูลไปยังหน้าอ่านการ์ตูน
        return redirect()->route('read.read_comic', ['bookID' => $bookID])
            ->with(['comic' => $comic]);
    }


    public function addToShelf(Request $request)
    {
        $request->validate([
            'bookID' => 'required|integer',
        ]);

        $username = Session::get('user'); // ดึงข้อมูล user จาก session
        if (is_object($username)) {
            $username = $username->username; // เป็น object
        } elseif (is_array($username)) {
            $username = $username['username']; // เป็น array
        }

        $existingBook = Bookshelf::where('bookID', $request->bookID)
            ->where('username', $username)
            ->first();
        if (!$existingBook) {
            Bookshelf::create([
                'bookID' => $request->bookID,
                'username' => $username,
            ]);
            $alert_session = "success_message";
            $message = 'เพิ่มเข้าชั้นสำเร็จ';
        } else {
            $alert_session = "error_message";
            $message = 'หนังสืออยู่ในชั้นหนังสืออยู่แล้ว';
        }

        return redirect()->back()->with($alert_session, $message);

    }

    function comment_novel($bookID, $chapterID, Request $request){
        $user = Userdb::where('username', Session::get('user')->username)->first();
        $chapter = Book_chapter::where("chapterID", $chapterID)->where("bookID", $bookID)->first();
        
        $comment = new Chapter_comment;
        $comment->chapterID = $chapter->chapterID;
        $comment->username = $user->username;
        $comment->comment_message = $request->input('comment_message');
        $comment->save();

        return redirect("/read_chaptnovel/{$bookID}/{$chapterID}");
    }

    function comment_comic($bookID, $chapterID, Request $request){
        $user = Userdb::where('username', Session::get('user')->username)->first();
        $chapter = Book_chapter::where("chapterID", $chapterID)->where("bookID", $bookID)->first();
        
        $comment = new Chapter_comment;
        $comment->chapterID = $chapter->chapterID;
        $comment->username = $user->username;
        $comment->comment_message = $request->input('comment_message');
        $comment->save();
        
        return redirect("/read_chaptcomic/{$bookID}/{$chapterID}");
    }


    function DeleteOutOfShelve(Request $request , $bookID){
        $book = Bookshelf::where("username",Session::get("user")->username)->where("bookID",$bookID)->first();

        if(!$book){
            return abort(404);
        }

        $book->forceDelete();

        return redirect()->back()->with(["success_message" => "ลบหนังสือออกจากชั้นหนังสือสำเร็จ"]);
    }

}