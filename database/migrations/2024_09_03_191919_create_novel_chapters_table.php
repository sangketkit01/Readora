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
        Schema::create('novel_chapters', function (Blueprint $table) {
            $table->increments("chapterID");
            $table->string("chapter_image");
            $table->unsignedInteger("novelID");
            $table->unsignedInteger("novelTypeID");
            $table->text("chapter_content");
            $table->string("chapter_name");
            $table->tinyInteger("chapter_status")->default(1);
            $table->string("writer_message");
            $table->tinyInteger("allow_comment");
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("novelID")->references("novelID")->on("novels")->onDelete("cascade");
            $table->foreign("novelTypeID")->references("novelTypeID")->on("novel_types")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('novel_chapters');
    }
};
