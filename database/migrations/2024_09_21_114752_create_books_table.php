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
            $table->unsignedInteger("bookGenreID");
            $table->string("book_name");
            $table->string("book_pic");
            $table->text("book_description");
            $table->string("book_status",7)->default("public");
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("username")->references("username")->on("userdbs");
            $table->foreign("bookTypeID")->references("bookTypeID")->on("book_types");
            $table->foreign("bookGenreID")->references("bookGenreID")->on("book_genres");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
        Schema::table('books', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
