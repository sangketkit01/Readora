<?php

namespace App\Http\Controllers;
use App\Models\Novel;
use App\Models\Novel_type;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $novels = Novel::take(4)->get();
        return view("user.index", compact("novels"));
    }
    public function rec1()
    {
        $novel = Novel::all();
        return view("user.rec1", compact('novel'));
    }

    public function rec2()
    {
        $novel = Novel::all();
        return view("user.rec2", compact('novel'));
    }

}
