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
        $data = Book::where("bookID", $bookID)->first();
        $chapters = Book_chapter::where("bookID",$bookID)->get();
        $count_chapter = Book_chapter::where("bookID",$bookID)->count();

        if((!$data)){
            return abort(404);
        }

        return view("user.edit_novel", compact("data", "book_types","bookID","chapters","count_chapter"));
    }

    public function edit_insert(Request $request , $bookID){
        $book = Book::where("bookID",$bookID)->first();
        if(!$book){
            return abort(404);
        }


        if($request->has("inputImage")){
            $oldImage = $book->book_pic;
            $oldImage = str_replace("storage/", "public/", $oldImage);
            if ($oldImage && Storage::exists($oldImage)) {
                Storage::delete($oldImage);
            }

            $image = $request->file('inputImage');
            $newImageFileName = uniqid('', true) . '.' . $image->getClientOriginalExtension();
            $imageUrl = Storage::putFileAs('public/Picture', $image, $newImageFileName);
            $imageUrl = str_replace("public/", "storage/", $imageUrl);

            $book->book_pic = $imageUrl;
        }

        $book->book_name  = $request->title;
        $book->bookTypeID = $request->type;
        $book->book_description = $request->recommend;
        $book->book_status = (int) $request->status;
        $book->save();

        return redirect()->route("novel.edit",["bookID"=>$bookID]);
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
        if (!$book) {
            return redirect()->route('index')->withErrors(["msg" => "Something went wrong."]);
        }

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

    function EditChapter($bookID,$chapterID){
        $book = Book_chapter::where("chapterID",$chapterID)->where("bookID",$bookID)->first();
        if(!$book){
            return abort(404);
        }

        return view('user.edit_chapter',compact("book","bookID","chapterID"));
    }

    function EditChapterUpdate(Request $request,$bookID,$chapterID){
        $chapterContent = Book_chapter::where('bookID',$bookID)->where('chapterID',$chapterID)->first();

        if (!$chapterContent) {
            return redirect()->route('index')->withErrors(["msg" => "Something went wrong."]);
        }

        if($request->has('image')){
            $oldImage = $chapterContent->chapter_image;
            $oldImage = str_replace("storage/","public/",$oldImage);
            if ($oldImage && Storage::exists($oldImage)) {
                Storage::delete($oldImage);
            }       

            $image = $request->file('image');
            $newImageFileName = uniqid('', true) . '.' . $image->getClientOriginalExtension();
            $imageUrl = Storage::putFileAs('public/Chapter', $image, $newImageFileName);
            $imageUrl = str_replace("public/", "storage/", $imageUrl);

            $chapterContent->chapter_image = $imageUrl;
        }
        $chapterContent->chapter_content = $request->content;
        $chapterContent->chapter_name = $request->title;
        $chapterContent->writer_message = $request->writer_message;
        $chapterContent->allow_comment = $request->has('allow_comment') ? 1 : 0;
        $chapterContent->save();
        return redirect()->route('novel.edit',['bookID'=>$bookID]);
    }

    function NovelChapterUpdate(Request $request,$bookID,$chapterID){
        $chapter = Book_chapter::where("chapterID",$chapterID)->where("bookID",$bookID);
        if(!$chapter){
            return abort(404);
        }

    }

}
