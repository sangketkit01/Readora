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
        Schema::create('chapter_comics', function (Blueprint $table) {
            $table->increments("chapterID");
            $table->unsignedInteger("comicID");
            $table->string("chapter_name");
            $table->text("chapter_content");
            $table->string("writer_message");
            $table->unsignedInteger("commentID");

            $table->foreign("comicID")->references("comicID")->on("comics")->onDelete("cascade");
            $table->foreign("commentID")->references("commentID")->on("comments")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapter_comics');
    }
};
