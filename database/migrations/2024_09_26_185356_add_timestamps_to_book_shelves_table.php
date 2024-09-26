<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('book_shelves', function (Blueprint $table) {
            Schema::table('book_shelves', function (Blueprint $table) {
                $table->timestamps(); // เพิ่ม created_at และ updated_at
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('book_shelves', function (Blueprint $table) {
            Schema::table('book_shelves', function (Blueprint $table) {
            $table->dropTimestamps(); 
        });
        });
    }
};
