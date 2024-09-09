<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NovelController extends Controller
{
    //
    public function page(){
        if(!Session::has("user")){
            return redirect(route("sign_in"));
        }

        return view("user.create_novel");
    }

    public function insertNewNovel(Request $request){
        
    }
}
