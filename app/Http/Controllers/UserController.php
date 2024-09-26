<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userdb;
use App\Models\Book;
use App\Models\Book_chapter;
use App\Models\BookShelf;
use App\Models\Chapter_comment;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller{
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
        if ($request->hasFile('inputImage')) {
            $user = Userdb::where('username', Session::get('user')->username)->first();
            if ($user->profile) {
                $oldImage = str_replace("storage/", "public/", $user->profile);
                if (Storage::exists($oldImage)) {
                    Storage::delete($oldImage);
                }
            }
            $image = $request->file('inputImage');
            $newImageFileName = uniqid('', true) . '.' . $image->getClientOriginalExtension();
            $imageUrl = Storage::putFileAs('public/Profile', $image, $newImageFileName);
            $imageUrl = str_replace("public/", "storage/", $imageUrl);

            $user->profile = $imageUrl;
        }
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->gender = $request->input('gender');
        $user->save();
        return redirect()->route('profile');
    }

    // function book_shelve()
    // {
    //     $novels = Book::where('BooktypeID', 1)->where('book_status', 'public')->get();
    //     return view("user.book_shelve", compact('novels'));
    // }

    // public function book_shelve_commic()
    // {
    //     $comics = Book::where('BooktypeID', 2)->where('book_status', 'public')->get();
    //     return view("user.book_shelve_commic", compact('comics'));
    // }
    function BookShelfPage(){
        $user = Userdb::where('username', Session::get('user')->username)->first();
        $n_count = Book::where('username', $user->username)->where('bookTypeID', 1)->where('book_status', 'public')->count();
        $c_count = Book::where('username', $user->username)->where('bookTypeID', 2)->where('book_status', 'public')->count();
        $novels = BookShelf::where('username', Session::get('user')->username)->where('bookTypeID', 1)->get();
        $comics = BookShelf::where('username', Session::get('user')->username)->where('bookTypeID', 2)->get();
        return view('profile.book_shelf', compact('user', 'n_count', 'c_count', 'novels', 'comics'));
    }
    // function book_shelf_novel(){
    //     $novels = BookShelf::where('username', Session::get('user')->username)->where('BooktypeID', 1)->get();
    //     return view("book_shelve", compact('novels'));
    // }
    // function book_shelf_commic(){

    //     return view("book_shelve_commic", compact('comics'));
    // }

    function novelInfoPage(){
        $user = Userdb::where('username', Session::get('user')->username)->first();
        $n_count = Book::where('username', $user->username)->where('bookTypeID', 1)->where('book_status', 'public')->count();
        $c_count = Book::where('username', $user->username)->where('bookTypeID', 2)->where('book_status', 'public')->count();
        $novel = Book::where('username', $user->username)->where('bookTypeID', 1)->get();
        $n_chapter = Book_chapter::where('BookID', $novel)->count();
        // $sum_comments = 0;
        // foreach($novel as $n){
        //     $chapters = $n->Chapters;
        //     dd($chapters);
        // }

        
        // $comment_comic = 
        $comment_novel = Chapter_comment::where('chapterID',)->count();
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
    
        $n_count = Book::where('username', $user->username)->where('bookTypeID', 1)->where('book_status', 'public')->count();
        return view('profile.comic_info', compact('user', 'comic', 'c_count', 'n_count', 'c_chapter'));
    }

    function viewCreatePassword(){
        return view('profile.create_password');
    }
    function create_password(Request $request){
        $request->validate([
            "new_password" => "required|min:8",
            "confirm_password" => "same:new_password"
        ]);
        $user = Userdb::where('username', Session::get('user')->username)->first();
        $user->password = Hash::make($request->input("new_password"));
        $user->save();
        return redirect()->route('create.password.page')->with(['new_password' => 'สร้างรหัสผ่านสำเร็จ']);
    }
    
    function viewChangePassword(){
        return view('profile.change_password');
    }
    function change_password(Request $request){
        $request->validate([
            "current_password" => "required",
            "new_password" => "required",
            "confirm_password" => "same:new_password"
        ]);
        $user = Userdb::where('username', Session::get('user')->username)->first();

        if(Hash::check($request->input('current_password'), $user->password)) {
            $user->password = Hash::make($request->input("new_password"));
            $user->save();
            Session::put('user',$user); 
            return redirect()->route('change.password.page')->with(['new_password' => 'เปลี่ยนรหัสผ่านสำเร็จ']);
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

