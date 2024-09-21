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
        Schema::create('book_shelves', function (Blueprint $table) {
            $table->string("username");
            $table->unsignedInteger("bookID");

            $table->primary(["username","bookID"]);
            $table->foreign("username")->references("username")->on("userdbs");
            $table->foreign("bookID")->references("bookID")->on("books");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_shelves');
    }
};
