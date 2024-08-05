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
        Schema::create('novels', function (Blueprint $table) {
            $table->increments("novelID");
            $table->unsignedInteger("writerID");
            $table->string("novel_name");
            $table->text("novel_detail");
            $table->tinyInteger("status")->default(1);

            $table->foreign("writerID")->references("writerID")->on("writers")->onDelete("cascade");
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('novels');
    }
};
