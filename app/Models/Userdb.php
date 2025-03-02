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
    public $incrementing = false;
    protected $keyType = 'string'; 

    function Books(){
        return $this->hasMany(Book::class);
    }

    public function BookAll(){
        return $this->belongsToMany(Book::class, 'book_shelves', 'username', 'bookID');
    }

    function BookShelves(){
        return $this->hasMany(Bookshelf::class);
    }

    function Comments(){
        return $this->hasMany(Chapter_comment::class);
    }

    function Reports(){
        return $this->hasMany(Report::class);
    }
}
