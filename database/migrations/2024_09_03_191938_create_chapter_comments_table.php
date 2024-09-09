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
        Schema::create('chapter_comments', function (Blueprint $table) {
            $table->increments("commentID");
            $table->unsignedInteger("chapterID");
            $table->string("username");
            $table->string("comment_message",255);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("chapterID")->references("chapterID")->on("book_chapters")->onDelete("cascade");
            $table->foreign("username")->references("username")->on("userdbs")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapter_comments');
    }
};
