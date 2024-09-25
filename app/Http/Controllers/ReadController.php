<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Book_type;
use App\Models\Book_chapter;
use App\Models\Chapter_comment;
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
        $count_chapter = Book_chapter::where("bookID", $bookID)->count();
        $count_comment = Chapter_comment::whereIn('chapterID', function ($query) use ($bookID) {
            $query->select('chapterID')
                ->from('book_chapters')
                ->where('bookID', $bookID);
        })->count();
        return view("user.read_novel", compact('books', 'bookID', 'chapters', 'count_chapter', 'chapterComments', 'count_comment'));
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

        $chapterComments = Chapter_comment::where('chapterID', $chapterID)
            ->with('user')
            ->get();

        $commentCount = $chapterComments->count();

        return view('user.read_novel_chapter', compact("chapters", "chapterID", "books", 'previousChapter', 'nextChapter', 'chapterComments', 'commentCount'));
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
        $count_chapter = Book_chapter::where("bookID", $bookID)->count();
        $count_comment = Chapter_comment::whereIn('chapterID', function ($query) use ($bookID) {
            $query->select('chapterID')
                ->from('book_chapters')
                ->where('bookID', $bookID);
        })->count();
        return view("user.read_comic", compact('books', 'bookID', 'chapters', 'count_chapter', 'chapterComments', 'count_comment'));
    }

    public function readcomic_chapt($bookID, $chapterID)
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

        $chapterComments = Chapter_comment::where('chapterID', $chapterID)
            ->with('user')
            ->get();

        $commentCount = $chapterComments->count();

        return view('user.read_comic_chapter', compact("chapters", "chapterID", "books", 'previousChapter', 'nextChapter', 'chapterComments', 'commentCount'));
    }

}
