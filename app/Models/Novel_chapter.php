<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Novel_chapter extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'novel_chapters';
    protected $primaryKey = 'chapterID';

    function Novel(){
        return $this->belongsTo(Novel::class,"novelID");
    }

    function Type(){
        return $this->belongsTo(Novel_type::class,"novelTypeID");
    }

    function Comments(){
        return $this->hasMany(Chapter_comment::class,"commentID");
    }
}
