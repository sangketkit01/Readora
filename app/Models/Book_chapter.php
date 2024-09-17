<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book_chapter extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'book_chapters';
    protected $primaryKey = 'chapterID';

    function Book(){
        return $this->belongsTo(Book::class,"bookID");
    }

    function Type(){
        return $this->belongsTo(Book_type::class,"bookTypeID");
    }

    function Comments(){
        return $this->hasMany(Chapter_comment::class,"commentID");
    }
}
