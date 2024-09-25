<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Book_chapter;
use App\Models\Book_genre;
use App\Models\Book_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;

class NovelController extends Controller
{
    //

    public function Page(){
        $book_genres = Book_genre::all();
        return view("user.create_novel", compact("book_genres"));
    }

    public function InsertNewNovel(Request $request) {
        $file = $request->file('inputImage');
        $newFileName = uniqid('', true) . '.' . $file->getClientOriginalExtension();
        $fileUrl = Storage::putFileAs('public/Picture', $file, $newFileName);

        $fileUrl = str_replace("public/", "storage/", $fileUrl);

        $created_at = now();

        $data = [
            'username' => Session::get("user")->username,
            'bookGenreID' => (int) $request->genre,
            'bookTypeID' => 1,
            'book_name' => $request->title,
            'book_pic' => $fileUrl,
            'book_description' => $request->book_description,
            "book_status" => $request->status,
            "created_at" => $created_at
        ];

        DB::table('books')->insert($data);

        $bookID = DB::table("books")->where("username", Session::get("user")->username)->where("created_at", $created_at)->first();

        return redirect("/edit_novel/$bookID->bookID")->with(["successMsg" => "สร้างนิยายสำเร็จ\nคุณอยู่ในหน้าแก้ไขนิยายแล้ว"]);
    }


    public function Edit($bookID) {
        $book_genres = DB::table("book_genres")->get();
        $data = Book::where("bookID", $bookID)->first();
        $chapters = Book_chapter::where("bookID",$bookID)->get();
        $count_chapter = Book_chapter::where("bookID",$bookID)->count();

        if((!$data)){
            return abort(404);
        }

        return view("user.edit_novel", compact("data", "book_genres","bookID","chapters","count_chapter"));
    }

    public function EditInsert(Request $request , $bookID){
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
        $book->bookgenreID = $request->type;
        $book->book_description = $request->book_description;
        $book->book_status = $request->status;
        $book->save();

        return redirect()->route("novel.edit",["bookID"=>$bookID])->with(["successMsg" => "แก้ไขนิยายสำเร็จ"]);
    }

    public function AddChapter($bookID){
        return view("user.add_chapter", compact("bookID"));
    }

    public function InsertNewChapter(Request $request, $bookID) {

        $image = $request->file('image');
        $newImageFileName = uniqid('', true) . '.' . $image->getClientOriginalExtension();
        $imageUrl = Storage::putFileAs('public/Chapter', $image, $newImageFileName);
        $imageUrl = str_replace("public/", "storage/", $imageUrl);

        $writer_message = $request->writer_message == null ?  "ไม่มีข้อความจากนักเขียน" : $request->writer_message;

        $created_at = now();

        $book = Book::where("bookID", $bookID)->first();
        if (!$book) {
            return redirect()->route('index')->withErrors(["msg" => "Something went wrong."]);
        }

        $data = [
            'chapter_image' => $imageUrl,
            'bookID' => $bookID,
            'chapter_content' => $request->content,
            'chapter_status' => $request->status,
            'chapter_name' => $request->title,
            "writer_message" => $writer_message,
            "created_at" => $created_at
        ];

        DB::table('book_chapters')->insert($data);


        return redirect(route("novel.edit", ["bookID" => $bookID]))->with(["successMsg"=>"สร้างตอนใหม่สำเร็จ"]);
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
        $writer_message = $request->writer_message == null ?  "ไม่มีข้อความจากนักเขียน" : $request->writer_message;

        $chapterContent->chapter_content = $request->content;
        $chapterContent->chapter_name = $request->title;
        $chapterContent->writer_message = $writer_message;
        $chapterContent->save();
        return redirect()->route('novel.edit',['bookID'=>$bookID])->with(["successMsg" => "แก้ไขตอนสำเร็จ"]);
    }

    function ChapterStatusUpdate(Request $request,$bookID,$chapterID){
        $chapter = Book_chapter::where("chapterID",$chapterID)->where("bookID",$bookID)->first();
        if(!$chapter){
            return abort(404);
        }

        $chapter->chapter_status  = $request->status_chapter;
        $chapter->save();

        return redirect()->route("novel.edit",["bookID"=>$bookID]);

    }

    function Delete(Request $request , $bookID){
        $book = Book::where("bookID",$bookID)->first();
        $book_chapter = Book_chapter::where("bookID",$bookID)->get();

        if(!$book){
            return abort(404);
        }

        $book_image = $book->book_pic;
        $book_image = str_replace("storage/","public/",$book_image);
        if($book_image && Storage::exists($book_image)){
            Storage::move($book_image, 'public/Deleted/' . basename($book_image));
            
            $book->book_pic = 'storage/Deleted/' . basename($book_image);
            $book->save();
        }
        $book->delete();

        if($book_chapter->isEmpty()){
            return redirect()->route("index")->with(["successMsg" => "ลบนิยายสำเร็จ"]);
        }

        foreach($book_chapter as $chapter){
            $chapter_image = $chapter->chapter_image;
            $chapter_image = str_replace("storage/","public/",$chapter_image);
            if($chapter_image && Storage::exists($chapter_image)){
                Storage::move($chapter_image, 'public/DeletedChapter/' . basename($chapter_image));

                $chapter->chapter_image = 'storage/DeletedChapter/' . basename($chapter_image);
                $chapter->save();
            }
            $chapter->delete();
        }

        return redirect()->route("index")->with(["successMsg" => "ลบนิยายสำเร็จ"]);
    }

    function DeleteChapter(Request $request,$bookID,$chapterID){
        $book_chapter = Book_chapter::where("chapterID",$chapterID)->where("bookID",$bookID)->first();
        if(!$book_chapter){
            return abort(404);
        }

        $chapter_image = $book_chapter->chapter_image;
        $chapter_image = str_replace("storage/","public/",$chapter_image);
        if($chapter_image && Storage::exists($chapter_image)){
            Storage::move($chapter_image,'public/DeletedChapter/'.basename($chapter_image));

            $book_chapter->chapter_image = 'storage/DeletedChapter/' . basename($chapter_image);
            $book_chapter->save();
        }

        $book_chapter->delete();

        return redirect()->route('novel.edit', ['bookID' => $bookID])->with(["successMsg" => "ลบตอนสำเร็จ"]);
    }

    function Trash($bookID){
        $chapters = Book_chapter::where("bookID",$bookID)->onlyTrashed()->get();
        $count_chapter = Book_chapter::where("bookID",$bookID)->onlyTrashed()->count();

        return view("user.trash_novel",compact("chapters","count_chapter","bookID"));
    }

    function RestoreAll(Request $request,$bookID){
        $chapters = Book_chapter::where("bookID",$bookID)->onlyTrashed()->get();
        
        if($chapters->isEmpty()){
            return redirect()->route("novel.trash",["bookID"=>$bookID])->withErrors(["msg" => "Something went wrong. Please try again"]);
        }

        foreach($chapters as $chapter){
            $chapter_image = $chapter->chapter_image;
            $chapter_image = str_replace("storage/","public/",$chapter_image);
            if($chapter_image && Storage::exists($chapter_image)){
                Storage::move($chapter_image,"public/Chapter/". basename($chapter_image));

                $chapter->chapter_image = "storage/Chapter/". basename($chapter_image);
                $chapter->save(); 
            }

            $chapter->restore();
        }

        return redirect()->route("novel.edit",["bookID"=>$bookID])->with(["successMsg"=>"กู้คืนตอนสำเร็จ"]);
    }

    function RestoreEach(Request $request,$bookID,$chapterID){
        $chapter = Book_chapter::where("bookID",$bookID)->where("chapterID",$chapterID)->onlyTrashed()->first();
        
        if(!$chapter){
            return redirect()->route("novel.trash", ["bookID" => $bookID])->withErrors(["msg" => "Something went wrong. Please try again"]);
        }

        $chapter_image = $chapter->chapter_image;
        $chapter_image = str_replace("storage/", "public/", $chapter_image);
        if ($chapter_image && Storage::exists($chapter_image)) {
            Storage::move($chapter_image, "public/Chapter/" . basename($chapter_image));

            $chapter->chapter_image = "storage/Chapter/" . basename($chapter_image);
            $chapter->save();
        }

        $chapter->restore();
        return redirect()->route("comic.edit", ["bookID" => $bookID])->with(["successMsg" => "กู้คืนตอนสำเร็จ"]);
    }

}
