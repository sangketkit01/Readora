<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Book_type;
use App\Models\Book_chapter;
use App\Models\Chapter_comment;
use App\Models\Userdb;
use Illuminate\Http\Request;

class ReadController extends Controller
{
    public function read($bookID)
    {
        $books = Book::where("BookID", $bookID)->get();
        $chapters = Book_chapter::where("bookID", $bookID)
            ->where("chapter_status", 'public')->get();
        $count_chapter = Book_chapter::where("bookID", $bookID)->count();
        return view("user.read_novel", compact('books', 'bookID', 'chapters', 'count_chapter'));
    }

    public function readnovel_chapt($bookID, $chapterID)
    {
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
        return view('user.read_novel_chapter', compact("chapters", "chapterID", "books",'previousChapter', 'nextChapter'));
    }

    public function readFirstChapter($bookID)
    {
        $book = Book::where("BookID", $bookID)->first();
        $firstChapter = Book_chapter::where("bookID", $bookID)
            ->orderBy('chapterID', 'asc')
            ->first();
        return redirect()->route('read.read_chapt', [
            'bookID' => $bookID,
            'chapterID' => $firstChapter->chapterID
        ]);
    }
    public function store(Request $request)
    {
        Chapter_comment::create([
            'chapterID' => $request->input('chapterID'),
            'username' => Userdb::user()->username,
            'comment_message' => $request->input('comment_message'),
        ]);

        return redirect()->back()->with('success', 'ความคิดเห็นของคุณถูกส่งแล้ว!');
    }

}
