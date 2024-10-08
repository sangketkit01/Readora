<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "reports";
    protected $primaryKey = "reportID";

    protected $fillable = [
        'bookID',         
        'username',       
        'report_message', 
        'report_status',
    ];

    function Book(){
        return $this->belongsTo(Book::class,"bookID");
    }

    function User(){
        return $this->belongsTo(Userdb::class,"username","username");
    }

    
}
