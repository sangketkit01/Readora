<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isNull;

class NovelController extends Controller
{
    //
    public function page(){
        if(!Session::has("user")){
            return redirect(route("sign_in"));
        }

        $book_types = DB::table("book_types")->get();
        return view("user.create_novel",compact("book_types"));
    }

    public function insertNewNovel(Request $request){
        $file = $request->file('inputImage');
        $newFileName = uniqid('', true) . '.' . $file->getClientOriginalExtension();
        $fileUrl = Storage::putFileAs('public/Picture', $file, $newFileName);

        $data = [
            'name' => $request->input('title'),
            'page' => $request->input('page'),
            'brief_content' => $request->input('brief_content'),
            'location' => $request->input('location'),
            'url' => Storage::url($fileUrl)
        ];

        DB::table('books')->insert($data);
    }

}
