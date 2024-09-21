<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Book_chapter;
use App\Models\Book_type;
use App\Models\Book_genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ComicController extends Controller
{
    public function page()
    {
        $book_genres = Book_genre::all();
        return view("user.create_comic", compact("book_genres"));
    }

    public function InsertNewComic(Request $request) {
        $file = $request->file('inputImage');
        $newFileName = uniqid('', true) . '.' . $file->getClientOriginalExtension();
        $fileUrl = Storage::putFileAs('public/Picture', $file, $newFileName);

        $fileUrl = str_replace("public/", "storage/", $fileUrl);

        $created_at = now();

        $recommend = $request->input("book-description");
        if($recommend === "เพิ่มคำแนะนำเรื่อง" || trim($recommend) === ""){
            $recommend = "ไม่มีคำแนะนำเรื่อง";
        }

        $data = [
            'username' => Session::get("user")->username,
            'bookGenreID' => (int) $request->input("genre"),
            'bookTypeID' => 2,
            'book_name' => $request->input("book_name"),
            'book_pic' => $fileUrl,
            'book_description' => $recommend,
            "book_status" => $request->input("status"),
            "created_at" => $created_at
        ];

        DB::table('books')->insert($data);

        $bookID = DB::table("books")->where("username", Session::get("user")->username)->where("created_at", $created_at)->first();

        return redirect("/edit_comic/$bookID->bookID")->with(["successMsg" => "สร้างนิยายสำเร็จ\nคุณอยู่ในหน้าแก้ไขนิยายแล้ว"]);
    }


    public function edit($bookID)
    {

        $book_genres = DB::table("book_genres")->get();
        $data = Book::where("bookID", $bookID)->first();
        $chapters = Book_chapter::where("bookID",$bookID)->get();
        $count_chapter = Book_chapter::where("bookID",$bookID)->count();

        if((!$data)){
            return abort(404);
        }

        return view("user.edit_comic", compact("data", "book_genres","bookID","chapters","count_chapter"));
    }

    public function EditInsert(Request $request , $bookID){
        $book = Book::where("bookID",$bookID)->first();
        if(!$book){
            return abort(404);
        }

        $recommend = $request->input("book-description");
        if ($recommend === "เพิ่มคำแนะนำเรื่อง" || trim($recommend) === "") {
            $recommend = "ไม่มีคำแนะนำเรื่อง";
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
        $book->bookgenreID = $request->type;
        $book->book_description = $recommend;
        $book->book_status = $request->status;
        $book->save();

        return redirect()->route("comic.edit",["bookID"=>$bookID])->with(["successMsg" => "แก้ไขนิยายสำเร็จ"]);
    }

    function ChapterStatusUpdate(Request $request,$bookID,$chapterID){
        $chapter = Book_chapter::where("chapterID",$chapterID)->where("bookID",$bookID)->first();
        if(!$chapter){
            return abort(404);
        }

        $chapter->chapter_status  = $request->status_chapter;
        $chapter->save();

        return redirect()->route("comic.edit",["bookID"=>$bookID]);

    }

    public function AddChapter($bookID){
        return view("user.add_comic_chapter", compact("bookID"));
    }

    public function InsertNewChapter(Request $request, $bookID) {

        $image = $request->file('image');
        $newImageFileName = uniqid('', true) . '.' . $image->getClientOriginalExtension();
        $imageUrl = Storage::putFileAs('public/Chapter', $image, $newImageFileName);
        $imageUrl = str_replace("public/", "storage/", $imageUrl);

        $created_at = now();
        $book = Book::where("bookID", $bookID)->first();
        if (!$book) {
            return redirect()->route('index')->withErrors(["msg" => "Something went wrong."]);
        }

        $data = [
            'chapter_image' => $imageUrl,
            'bookID' => $bookID,
            'chapter_content' => $request->input("content"),
            'chapter_name' => $request->input("title"),
            "writer_message" => $request->input("writer_message"),
            "created_at" => $created_at
        ];

        DB::table('book_chapters')->insert($data);


        return redirect(route("comic.edit", ["bookID" => $bookID]))->with(["successMsg"=>"สร้างตอนใหม่สำเร็จ"]);
    }

    function EditChapter($bookID,$chapterID){
        $book = Book_chapter::where("chapterID",$chapterID)->where("bookID",$bookID)->first();
        if(!$book){
            return abort(404);
        }

        return view('user.edit_comic_chapter',compact("book","bookID","chapterID"));
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
        $chapterContent->save();
        return redirect()->route('novel.edit',['bookID'=>$bookID])->with(["successMsg" => "แก้ไขตอนสำเร็จ"]);
    }

}
