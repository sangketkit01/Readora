<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Book_chapter;
use App\Models\Book_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class NovelController extends Controller
{
    //

    public function page()
    {
        $book_types = Book_type::all();
        return view("user.create_novel", compact("book_types"));
    }

    public function insertNewNovel(Request $request)
    {
        $file = $request->file('inputImage');
        $newFileName = uniqid('', true) . '.' . $file->getClientOriginalExtension();
        $fileUrl = Storage::putFileAs('public/Picture', $file, $newFileName);

        $fileUrl = str_replace("public/", "storage/", $fileUrl);

        $created_at = now();

        $data = [
            'username' => Session::get("user")->username,
            'bookTypeID' => (int) $request->input("type"),
            'book_name' => $request->input("title"),
            'book_pic' => $fileUrl,
            'book_description' => $request->input("recommend"),
            "book_status" => (int) $request->input("status"),
            "created_at" => $created_at
        ];

        DB::table('books')->insert($data);

        $bookID = DB::table("books")->where("username", Session::get("user")->username)->where("created_at", $created_at)->first();

        return redirect("/edit_novel/$bookID->bookID");
    }


    public function edit($bookID)
    {

        $book_types = DB::table("book_types")->get();
        $data = Book::where("bookID", $bookID)->get();
        $chapters = Book_chapter::where("bookID",$bookID)->get();
        $count_chapter = Book_chapter::where("bookID",$bookID)->count();

        return view("user.edit_novel", compact("data", "book_types","bookID","chapters","count_chapter"));
    }

    public function edit_insert(Request $request , $bookID){
        
    }

    public function AddChapter($bookID)
    {
        return view("user.add_chapter", compact("bookID"));
    }

    public function InsertNewChapter(Request $request, $bookID)
    {

        $image = $request->file('image');
        $newImageFileName = uniqid('', true) . '.' . $image->getClientOriginalExtension();
        $imageUrl = Storage::putFileAs('public/Chapter', $image, $newImageFileName);
        $imageUrl = str_replace("public/", "storage/", $imageUrl);

        $created_at = now();
        $book = Book::where("bookID", $bookID)->first();

        $allow_comment = $request->has('allow_comment') ? 1 : 0;

        $data = [
            'chapter_image' => $imageUrl,
            'bookID' => $bookID,
            'bookTypeID' => $book->bookTypeID,
            'chapter_content' => $request->input("content"),
            'chapter_name' => $request->input("title"),
            "writer_message" => $request->input("writer_message"),
            "allow_comment" => $allow_comment,
            "created_at" => $created_at
        ];

        DB::table('book_chapters')->insert($data);


        return redirect(route("novel.edit", ["bookID" => $bookID]));
    }

}
