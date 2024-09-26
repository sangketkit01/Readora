<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userdb;
use App\Models\Book;
use App\Models\Book_chapter;
use App\Models\Chapter_comment;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    function profile(){
        $user = Userdb::where('username', Session::get('user')->username)->first();
        $novels = Book::where('username', $user->username)->where('bookTypeID', 1)->get();
        $n_count = Book::where('username', $user->username)->where('bookTypeID', 1)->where('book_status', 'public')->count();
        $comics = Book::where('username', $user->username)->where('bookTypeID', 2)->get();
        $c_count = Book::where('username', $user->username)->where('bookTypeID', 2)->where('book_status', 'public')->count();
        return view('profile.main', compact('user','novels', 'n_count', 'comics', 'c_count'));
    }

    function editInfoPage($username){
        $user = Userdb::where('username', Session::get('user')->username)->first();
        $n_count = Book::where('username', $user->username)->where('bookTypeID', 1)->where('book_status', 'public')->count();
        $c_count = Book::where('username', $user->username)->where('bookTypeID', 2)->where('book_status', 'public')->count();
        return view('profile.main', compact('user', 'username', 'n_count', 'c_count'));
    }
    function edit_info(Request $request){
        $user = Userdb::where('username', Session::get('user')->username)->first();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->gender = $request->input('gender');
        $user->save();
        return redirect()->route('profile');
    }

    function novelInfoPage(){
        $user = Userdb::where('username', Session::get('user')->username)->first();
        $novel = Book::where('username', $user->username)->where('bookTypeID', 1)->get();

        $n_chapter = null;
        if(!$novel->isEmpty()){
            $n_chapter =  Book_chapter::where('bookID', $novel->first()->bookID)->where('chapter_status', 'public')->count();
        }
        $n_chapter = Book_chapter::where('bookID', $novel->first()->bookID)->where('chapter_status', 'public')->count();
        $n_count = Book::where('username', $user->username)->where('bookTypeID', 1)->where('book_status', 'public')->count();
        // $comment_comic = 
        // $comment_novel = 
        $c_count = Book::where('username', $user->username)->where('bookTypeID', 2)->where('book_status', 'public')->count();
        return view('profile.novel_info', compact('user', 'novel', 'c_count', 'n_count', 'n_chapter'));
    }

    function comicInfoPage(){
        $user = Userdb::where('username', Session::get('user')->username)->first();
        $comic = Book::where('username', $user->username)->where('bookTypeID', 2)->get();

        $c_chapter = null;
        if(!$comic->isEmpty()){
            $c_chapter =  Book_chapter::where('bookID', $comic->first()->bookID)->where('chapter_status', 'public')->count();
        }
        $c_count = Book::where('username', $user->username)->where('bookTypeID', 2)->count();
        // $comment_comic = Chapter_comment::all('bookTypeID', 2)->where('chapterID')->count(); //เช็คจำนวนคอมเม้นของทุกตอนในเรื่องนั้นยังไง
        $n_count = Book::where('username', $user->username)->where('bookTypeID', 1)->where('book_status', 'public')->count();
        return view('profile.comic_info', compact('user', 'comic', 'c_count', 'n_count', 'c_chapter'));
    }

    function viewCreatePassword(){
        return view('profile.create_password');
    }
    function create_password(Request $request){
        $request->validate([
            "password" => "min:8",
            "confirm" => "same:password"
        ],[
            "password.min" => "รหัสผ่านต้องมีขั้นต่ำ 8 ตัวอักษร",
            "confirm.same" => "รหัสผ่านไม่ตรงกัน"
        ]);
        $user = Userdb::where('username', Session::get('user')->username)->first();
        $user->password = Hash::make($request->input("password"));
        $user->save();
        return redirect()->route('profile');
    }
    
    function viewChangePassword(){
        return view('profile.change_password');
    }
    function change_password(Request $request){

        $request->validate([
            "current_password" => "required",
            "password" => "min:8",
            "confirm" => "same:password"
        ],[
            "password.min" => "รหัสผ่านต้องมีขั้นต่ำ 8 ตัวอักษร",
            "confirm.same" => "รหัสผ่านไม่ตรงกัน"
        ]);
        $user = Userdb::where('username', Session::get('user')->username)->first();
        if(Hash::check($request->input('current_password'), $user->password)) {
            $user->password = Hash::make($request->input("n-password"));
            $user->save();
            Session::put('user',$user); 
            return redirect()->route('profile');
        }else {
            return back()->withErrors(['current_password' => 'รหัสผ่านปัจจุบันไม่ถูกต้อง']);
        }
    }
    

    function Trash($bookTypeID){
        $books = Book::where("username",Session::get("user")->username)->where("bookTypeID",$bookTypeID)->onlyTrashed()->get();
        return view("user.user_bin",compact("books","bookTypeID"));
    }

    function RestoreEach(Request $request ,$bookTypeID, $bookID){
        $book = Book::where("bookID",$bookID)->where("bookTypeID", $bookTypeID)->onlyTrashed()->first();
        $bookType_name = $bookTypeID == 1 ? "novel" : "comic";
        $bookType_name_thai = $bookTypeID == 1 ? "นิยาย" : "คอมมิค";

        if(!$book){
            return abort(404);
        }

        $book_pic = $book->book_pic;
        $book_pic = str_replace("storage/","public/",$book_pic);
        if($book_pic && Storage::exists($book_pic)){
            Storage::move($book_pic,"public/Picture/". basename($book_pic));

            $book->book_pic = "storage/Picture/". basename($book_pic);
            $book->save();
        }

        $book->restore();

        return redirect()->route("$bookType_name.edit",["bookID"=>$bookID])->with(["successMsg"=>"กู้คืน".$bookType_name_thai."สำเร็จ"]);
    }

    function RestoreAll(Request $request,$bookTypeID){
        $books = Book::where("username",Session::get("user")->username)->where("bookTypeID",$bookTypeID)->onlyTrashed()->get();

        if($books->isEmpty()){
            return abort(404);
        }

        foreach($books as $book){
            $book_pic = $book->book_pic;
            $book_pic = str_replace("storage/", "public/", $book_pic);
            if ($book_pic && Storage::exists($book_pic)) {
                Storage::move($book_pic, "public/Picture/" . basename($book_pic));

                $book->book_pic = "storage/Picture/" . basename($book_pic);
                $book->save();
            }

            $book->restore();
        }

        return redirect()->route("index")->with(["successMsg" => "กู้คืนนิยายสำเร็จ"]);
    }
}
