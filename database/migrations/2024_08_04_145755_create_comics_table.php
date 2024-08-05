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
        Schema::create('comics', function (Blueprint $table) {
            $table->increments("comicID");
            $table->unsignedInteger("writerID");
            $table->string("comic_name");
            $table->text("comic_detail");
            $table->tinyInteger("comic_status")->default(1);
            $table->timestamps();

            $table->foreign("writerID")->references("writerID")->on("writers")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comics');
    }
};
