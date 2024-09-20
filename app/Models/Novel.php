<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Novel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'novels';
    protected $primaryKey = 'novelID';

    function NovelType(){
        return $this->belongsTo(Novel_type::class,"novelTypeID");
    }

    function Chapter(){
        return $this->hasMany(Novel_chapter::class,"chapterID");
    }

    function User(){
        return $this->belongsTo(Userdb::class,"username");
    }

    function Users(){
        return $this->belongsToMany(Userdb::class,"username");
    }

    function Reports(){
        return $this->hasMany(Report::class,"reportID");
    }
}
