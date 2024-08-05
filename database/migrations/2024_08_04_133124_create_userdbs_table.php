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
            $table->increments('userID'); 
            $table->string("profile")->nullable();
            $table->string('username');
            $table->string('password')->nullable();
            $table->string('email');
            $table->char('gender', 1)->nullable();
            $table->tinyInteger("status")->default(1);
            $table->timestamps(); 
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
