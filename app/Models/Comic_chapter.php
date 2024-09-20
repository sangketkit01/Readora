<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comic_chapter extends Model
{
    use HasFactory;

    protected $table = "comic_chapters";
    protected $primaryKey = "comic_chapterID";

    function Comic(){
        return $this->belongsTo(Comic::class,"comicID");
    }

    function Type(){
        return $this->belongsTo(Comic_type::class,"comicTypeID");
    }
}
