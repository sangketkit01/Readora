<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isNull;

class NovelController extends Controller
{
    //

    function checkLoggedIn(){
        if (!Session::has("user")) {
            return redirect(route("sign_in"));
        }
    }

    public function page(){
        if($this->checkLoggedIn()){
            return $this->checkLoggedIn();
        }

        $book_types = DB::table("book_types")->get();
        return view("user.create_novel",compact("book_types"));
    }

    public function insertNewNovel(Request $request){
        if ($this->checkLoggedIn()) {
            return $this->checkLoggedIn();
        }


        $file = $request->file('inputImage');
        $newFileName = uniqid('', true) . '.' . $file->getClientOriginalExtension();
        $fileUrl = Storage::putFileAs('public/Picture', $file, $newFileName);

        $fileUrl = str_replace("public/","storage/",$fileUrl);

        $created_at = now();

        $data = [
            'username' => Session::get("user")->username,
            'bookTypeID' => (int)$request->input("type"),
            'book_name' => $request->input("title"),
            'book_pic' => $fileUrl,
            'book_description' => $request->input("recommend"),
            "book_status" => (int) $request->input("status") ,
            "created_at" => $created_at
        ];

        DB::table('books')->insert($data);

        $bookID = DB::table("books")->where("username",Session::get("user")->username)->where("created_at",$created_at)->first();

        return redirect("/edit_novel/$bookID->bookID");
    }


    public function edit($bookID){
        if ($this->checkLoggedIn()) {
            return $this->checkLoggedIn();
        }

        $book_types = DB::table("book_types")->get();
        $data = Book::where("bookID",$bookID)->get();

        return view("user.edit_novel",compact("data","book_types"));
    }

}
