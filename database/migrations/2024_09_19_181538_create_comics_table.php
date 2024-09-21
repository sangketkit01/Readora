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
            $table->string("username");
            $table->unsignedInteger("comicTypeID");
            $table->string("comic_name");
            $table->string("comic_pic");
            $table->string("comic_description");
            $table->tinyInteger("comic_status")->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("username")->references("username")->on("userdbs")->onDelete("cascade");
            $table->foreign("comicTypeID")->references("comicTypeID")->on("comic_types");
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
