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
        Schema::create('admins', function (Blueprint $table) {
            $table->increments("adminID");
            $table->string("username");
            $table->string("email");
            $table->char("cardID",13);
            $table->date("birthdate");
            $table->char("phone",10);
            $table->char("gender",1);
            $table->string("education");
            $table->string("university");
            $table->string("major");
            $table->string("role");
            $table->string("department");
            $table->date("started_date");
            $table->string("corporate_email");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
