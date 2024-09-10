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
        return $this->belongsTo(Book_type::class);
    }

    function Chapter(){
        return $this->hasMany(Book_chapter::class);
    }

    function User(){
        return $this->belongsTo(Userdb::class);
    }

    function Users(){
        return $this->belongsToMany(Userdb::class);
    }

    function Reports(){
        return $this->hasMany(Report::class);
    }
}
