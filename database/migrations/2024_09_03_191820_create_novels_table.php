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
            $table->string("username");
            $table->unsignedInteger("novelTypeID");
            $table->string("novel_name");
            $table->string("novel_pic");
            $table->string("novel_description");
            $table->tinyInteger("novel_status")->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("username")->references("username")->on("userdbs")->onDelete("cascade");
            $table->foreign("novelTypeID")->references("novelTypeID")->on("novel_types");
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
