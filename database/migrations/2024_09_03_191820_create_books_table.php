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
        Schema::create('books', function (Blueprint $table) {
            $table->increments("bookID");
            $table->string("username");
            $table->unsignedInteger("bookTypeID");
            $table->string("book_name");
            $table->string("book_pic");
            $table->string("book_description");
            $table->tinyInteger("book_status");
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("username")->references("username")->on("userdbs")->onDelete("cascade");
            $table->foreign("bookTypeID")->references("bookTypeID")->on("book_types");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
