<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bookshelf extends Model{

    use HasFactory, SoftDeletes;

    protected $table = 'book_shelves';

    protected $primaryKey = 'bookID';
    public $incrementing = false;

    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'bookID',
        'username'
    ];

    public function Books()
    {
        return $this->belongsTo(Book::class, 'bookID');
    }

    public function Users()
    {
        return $this->belongsTo(Userdb::class, 'username');
    }
}
