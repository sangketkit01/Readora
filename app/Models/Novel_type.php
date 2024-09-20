<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Novel_type extends Model
{
    use HasFactory;

    protected $table = 'novel_types';
    protected $primaryKey = 'novelTypeID';

    function Novels(){
        return $this->hasMany(Novel::class,"novelID");
    }
}
