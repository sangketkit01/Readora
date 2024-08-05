<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NovelController extends Controller
{
    //
    function novel_list(){
        return view("reader.novel_list");
    }

    function novel(){
        return view("reader.novel");
    }

    function novel_detail($id){
        return view('reader.novel_detail');
    }
}
