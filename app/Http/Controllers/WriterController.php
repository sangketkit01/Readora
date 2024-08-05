<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WriterController extends Controller
{
    //
    function create(){
        return view("writer.create_novel");
    }

    function edit($id){
        return view('writer.edit_novel');
    }

    function mynovel(){
        return view('writer.mynovel');
    }

    function novel_detail($id){
        return view('writer.novel_detail');
    }

    function stat(){
        return view("writer.stat");
    }
}
