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
            $table->increments("chapterID");
            $table->unsignedInteger("bookID");
            $table->string("chapter_status",7)->default("public");
            $table->string("chapter_name");
            $table->string("chapter_image");
            $table->text("chapter_content");
            $table->text("writer_message");
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("bookID")->references("bookID")->on("books");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_chapters');
        Schema::table('book_chapters', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
