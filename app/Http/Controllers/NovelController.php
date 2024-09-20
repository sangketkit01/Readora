<?php

namespace App\Http\Controllers;

use App\Models\Novel;
use App\Models\Novel_chapter;
use App\Models\Novel_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class NovelController extends Controller
{
    //

    public function page()
    {
        $novel_types = Novel_type::all();
        return view("user.create_novel", compact("novel_types"));
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
            'novelTypeID' => (int) $request->input("type"),
            'novel_name' => $request->input("title"),
            'novel_pic' => $fileUrl,
            'novel_description' => $request->input("recommend"),
            "novel_status" => (int) $request->input("status"),
            "created_at" => $created_at
        ];

        DB::table('novels')->insert($data);

        $novelID = DB::table("novels")->where("username", Session::get("user")->username)->where("created_at", $created_at)->first();

        return redirect("/edit_novel/$novelID->novelID");
    }


    public function edit($novelID)
    {

        $novel_types = DB::table("novel_types")->get();
        $data = Novel::where("novelID", $novelID)->first();
        $chapters = Novel_chapter::where("novelID",$novelID)->get();
        $count_chapter = Novel_chapter::where("novelID",$novelID)->count();

        if((!$data)){
            return abort(404);
        }

        return view("user.edit_novel", compact("data", "novel_types","novelID","chapters","count_chapter"));
    }

    public function edit_insert(Request $request , $novelID){
        $novel = Novel::where("novelID",$novelID)->first();
        if(!$novel){
            return abort(404);
        }


        if($request->has("inputImage")){
            $oldImage = $novel->novel_pic;
            $oldImage = str_replace("storage/", "public/", $oldImage);
            if ($oldImage && Storage::exists($oldImage)) {
                Storage::delete($oldImage);
            }

            $image = $request->file('inputImage');
            $newImageFileName = uniqid('', true) . '.' . $image->getClientOriginalExtension();
            $imageUrl = Storage::putFileAs('public/Picture', $image, $newImageFileName);
            $imageUrl = str_replace("public/", "storage/", $imageUrl);

            $novel->novel_pic = $imageUrl;
        }

        $novel->novel_name  = $request->title;
        $novel->novelTypeID = $request->type;
        $novel->novel_description = $request->recommend;
        $novel->novel_status = (int) $request->status;
        $novel->save();

        return redirect()->route("novel.edit",["novelID"=>$novelID]);
    }

    public function AddChapter($novelID)
    {
        return view("user.add_chapter", compact("novelID"));
    }

    public function InsertNewChapter(Request $request, $novelID)
    {

        $image = $request->file('image');
        $newImageFileName = uniqid('', true) . '.' . $image->getClientOriginalExtension();
        $imageUrl = Storage::putFileAs('public/Chapter', $image, $newImageFileName);
        $imageUrl = str_replace("public/", "storage/", $imageUrl);

        $created_at = now();
        $novel = Novel::where("novelID", $novelID)->first();
        if (!$novel) {
            return redirect()->route('index')->withErrors(["msg" => "Something went wrong."]);
        }

        $allow_comment = $request->has('allow_comment') ? 1 : 0;

        $data = [
            'chapter_image' => $imageUrl,
            'novelID' => $novelID,
            'novelTypeID' => $novel->novelTypeID,
            'chapter_content' => $request->input("content"),
            'chapter_name' => $request->input("title"),
            "writer_message" => $request->input("writer_message"),
            "allow_comment" => $allow_comment,
            "created_at" => $created_at
        ];

        DB::table('novel_chapters')->insert($data);


        return redirect(route("novel.edit", ["novelID" => $novelID]));
    }

    function EditChapter($novelID,$chapterID){
        $novel = Novel_chapter::where("chapterID",$chapterID)->where("novelID",$novelID)->first();
        if(!$novel){
            return abort(404);
        }

        return view('user.edit_chapter',compact("novel","novelID","chapterID"));
    }

    function EditChapterUpdate(Request $request,$novelID,$chapterID){
        $chapterContent = Novel_chapter::where('novelID',$novelID)->where('chapterID',$chapterID)->first();

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
        return redirect()->route('novel.edit',['novelID'=>$novelID]);
    }

    function NovelChapterUpdate(Request $request,$novelID,$chapterID){
        $chapter = Novel_chapter::where("chapterID",$chapterID)->where("novelID",$novelID)->first();
        if(!$chapter){
            return abort(404);
        }

        $chapter->chapter_status  = $request->status_chapter;
        $chapter->save();

        return redirect()->route("novel.edit",["novelID"=>$novelID]);

    }

}
