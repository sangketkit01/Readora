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
        Schema::dropIfExists('writers');
        Schema::create('writers', function (Blueprint $table) {
            $table->increments("writerID")->primary();
            $table->unsignedInteger("userID");

            $table->foreign("userID")->references("userID")->on("userdbs")->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('writers');
    }
};
