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
            $table->string("password")->nullable();
            $table->string("name")->nullable();
            $table->string("profile")->nullable();
            $table->string("email")->nullable();
            $table->char("gender",1);
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
        Schema::table('userdbs', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
