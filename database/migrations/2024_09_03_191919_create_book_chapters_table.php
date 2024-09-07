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
        Schema::create('book_chapters', function (Blueprint $table) {
            $table->string("chapterID",10)->primary();
            $table->string("bookID",10);
            $table->unsignedInteger("bookTypeID");
            $table->text("chapter_content");
            $table->string("chapter_name",45);
            $table->string("writer_message",45);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("bookID")->references("bookID")->on("books")->onDelete("cascade");
            $table->foreign("bookTypeID")->references("bookTypeID")->on("book_types")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_chapters');
    }
};
