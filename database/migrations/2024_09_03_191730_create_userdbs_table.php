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
        Schema::create('userdbs', function (Blueprint $table) {
            $table->string("username")->primary();
            $table->string("profile")->nullable();
            $table->string("name");
            $table->string("password")->nullable();
            $table->string("email");
            $table->string("gender",4)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userdbs');
    }
};
