<?php

namespace App\Http\Controllers;

use App\Models\Comic;
use App\Models\Comic_chapter;
use App\Models\Comic_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ComicController extends Controller
{
    public function page()
    {
        $comic_types = Comic_type::all();
        return view("user.create_comic", compact("comic_types"));
    }

    public function insertNewComic(Request $request)
    {
        $file = $request->file('inputImage');
        $newFileName = uniqid('', true) . '.' . $file->getClientOriginalExtension();
        $fileUrl = Storage::putFileAs('public/Picture', $file, $newFileName);

        $fileUrl = str_replace("public/", "storage/", $fileUrl);

        $created_at = now();

        $data = [
            'username' => Session::get("user")->username,
            'comicTypeID' => (int) $request->input("type"),
            'comic_name' => $request->input("comic_name"),
            'comic_pic' => $fileUrl,
            'comic_description' => $request->input("comic-description"),
            "comic_status" => (int) $request->input("status"),
            "created_at" => $created_at
        ];

        DB::table('comics')->insert($data);

        $comicID = DB::table("comics")->where("username", Session::get("user")->username)->where("created_at", $created_at)->first();

        return redirect("/edit_comic/$comicID->comicID");
    }

    public function edit($comicID)
    {

        $novel_types = DB::table("comic_types")->get();
        $data = Comic::where("comicID", $comicID)->first();
        $chapters = Comic_chapter::where("comicID",$comicID)->get();
        $count_chapter = Comic_chapter::where("comicID",$comicID)->count();

        if((!$data)){
            return abort(404);
        }

        return view("user.edit_comic", compact("data", "novel_types","comicID","chapters","count_chapter"));
    }

}
