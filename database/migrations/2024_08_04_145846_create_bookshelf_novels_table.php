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
        Schema::create('bookshelf_novels', function (Blueprint $table) {
            $table->unsignedInteger("userID");
            $table->unsignedInteger("novelID");

            $table->primary(['userID', 'novelID']);
            
            $table->foreign("userID")->references("userID")->on("userdbs")->onDelete("cascade");
            $table->foreign("novelID")->references("novelID")->on("novels")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookshelf_novels');
    }
};
