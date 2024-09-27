<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "books";
    protected $primaryKey = "bookID";

    function Genre()
    {
        return $this->belongsTo(Book_genre::class, "bookGenreID");
    }

    function Type(){
        return $this->belongsTo(Book_type::class,"bookTypeID");
    }

    function User(){
        return $this->belongsTo(Userdb::class,"username");
    }

    function Users(){
        return $this->belongsToMany(Userdb::class,"username");
    }

    function Chapters(){
        return $this->hasMany(Book_chapter::class,"bookID");
    }

    function BookShelves(){
        return $this->hasMany(BookShelf::class,"bookID","bookID");

    }

    function Reports(){
        return $this->hasMany(Report::class,"bookID");
    }
}
