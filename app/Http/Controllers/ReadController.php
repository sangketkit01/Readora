<?php

namespace App\Http\Controllers;

use App\Models\Novel;
use App\Models\Novel_type;
use App\Models\Novel_chapter;
use Illuminate\Http\Request;

class ReadController extends Controller
{
    public function read_novel($novelID){
        $novels = Novel::where("NovelID",$novelID)->get();
        $chapters = Novel_chapter::where("novelID",$novelID)->get();
        $count_chapter = Novel_chapter::where("novelID",$novelID)->count();
        return view("user.read_novel", compact('novels','novelID','chapters','count_chapter'));
    } 
}
