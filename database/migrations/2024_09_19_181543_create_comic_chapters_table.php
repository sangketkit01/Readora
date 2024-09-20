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
        Schema::create('comic_chapters', function (Blueprint $table) {
            $table->increments("comic_chapterID");
            $table->string("chapter_image");
            $table->unsignedInteger("comicID");
            $table->unsignedInteger("comicTypeID");
            $table->string("chapter_name");
            $table->tinyInteger("chapter_status")->default(1);
            $table->string("chapter_content");
            $table->string("writer_message");
            $table->tinyInteger("allow_comment");
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("comicID")->references("comicID")->on("comics")->onDelete("cascade");
            $table->foreign("comicTypeID")->references("comicTypeID")->on("comic_types")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comic_chapters');
    }
};
