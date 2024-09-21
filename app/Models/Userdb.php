<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Userdb extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "userdbs";
    protected $primaryKey = "username";

    function Books(){
        return $this->hasMany(Book::class,"bookID");
    }

    function BookAll(){
        return $this->belongsToMany(Book::class,"bookID");
    }

    function BookShelves(){
        return $this->hasMany(BookShelf::class);
    }

    function Comments(){
        return $this->hasMany(Chapter_comment::class,"commentID");
    }

    function Reports(){
        return $this->hasMany(Report::class,"reportID");
    }
}
