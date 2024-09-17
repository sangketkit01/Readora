<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;
    use SoftDeletes;

    function BookType(){
        return $this->belongsTo(Book_type::class,"bookTypeID","bookTypeID");
    }

    function Chapter(){
        return $this->hasMany(Book_chapter::class,"chapterID");
    }

    function User(){
        return $this->belongsTo(Userdb::class,"username");
    }

    function Users(){
        return $this->belongsToMany(Userdb::class,"username");
    }

    function Reports(){
        return $this->hasMany(Report::class,"reportID");
    }
}
