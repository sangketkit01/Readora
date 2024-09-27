<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bookshelf extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'book_shelves';
    public $timestamps = true;

    protected $fillable = [
        'bookID',
        'username'
    ];


    public function book()
    {
        return $this->belongsTo(Book::class, "bookID","bookID");
    }

    public function user()
    {
        return $this->belongsTo(Userdb::class, "username");
    }



}
