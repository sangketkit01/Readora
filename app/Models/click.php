<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Novel extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_name',
        'book_description',
        'book_pic',
        'click_count'  
    ];

    // ความสัมพันธ์กับ User model (ถ้ามี)
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    // ฟังก์ชันอื่นๆ ที่เกี่ยวข้องกับ Novel...
}