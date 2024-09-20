<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comic_type extends Model
{
    use HasFactory;

    function Comics(){
        return $this->hasMany(Comic::class,"comicID");
    }

    function Chapters(){
        return $this->hasMany(Comic_chapter::class,"comic_chapterID");
    }
}
