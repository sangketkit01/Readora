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
            $table->string("admin_username");
            $table->string("admin_password");
            $table->string("admin_name");
            $table->string("admin_email");
            $table->string("admin_profile");
            $table->char("admin_phone",10);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
        Schema::table('admins', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
