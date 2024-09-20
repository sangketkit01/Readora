<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{
    use HasFactory;

    protected $table = "comics";
    protected $primaryKey = "comicID";

    function User(){
        return $this->belongsTo(Userdb::class,"username");
    }

    function Type(){
        return $this->belongsTo(Comic_type::class,"comicTypeID");
    }

    function Chapters(){
        return $this->hasMany(Comic_chapter::class,'comic_chapterID');
    }
}
