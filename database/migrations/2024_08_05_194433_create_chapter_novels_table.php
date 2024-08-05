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
        Schema::create('chapter_novels', function (Blueprint $table) {
            $table->increments("chapterID");
            $table->unsignedInteger("novelID");
            $table->string("chapter_name");
            $table->text("chapter_content");
            $table->string("writer_message");
            $table->unsignedInteger("commentID");

            $table->foreign("novelID")->references("novelID")->on("novels")->onDelete("cascade");
            $table->foreign("commentID")->references("commentID")->on("comments")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapter_novels');
    }
};
