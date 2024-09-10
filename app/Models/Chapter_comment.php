<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chapter_comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    function Chapter(){
        return $this->belongsTo(Book_chapter::class);
    }

    function User(){
        return $this->belongsTo(Userdb::class);
    }
}
