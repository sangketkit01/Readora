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
        Schema::create('reports', function (Blueprint $table) {
            $table->increments("reportID");
            $table->unsignedInteger("bookID");
            $table->string("username");
            $table->text("report_message");
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("bookID")->references("bookID")->on("books");
            $table->foreign("username")->references("username")->on("userdbs");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
        Schema::table('reports', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
