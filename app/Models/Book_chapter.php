<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book_chapter extends Model
{
    use HasFactory;
    use SoftDeletes;

    function Book(){
        return $this->belongsTo(Book::class);
    }

    function Type(){
        return $this->belongsTo(Book_type::class);
    }

    function Comments(){
        return $this->hasMany(Chapter_comment::class);
    }
}
