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
        Schema::create('bookshelves', function (Blueprint $table) {
            $table->string("username");
            $table->unsignedInteger("novelID");

            $table->primary(['username','novelID']);
            $table->foreign("username")->references("username")->on("userdbs")->onDelete("cascade");
            $table->foreign("novelID")->references("novelID")->on("novels")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookshelves');
    }
};
