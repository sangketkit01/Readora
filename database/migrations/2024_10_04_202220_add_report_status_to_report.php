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
        Schema::table('reports', function (Blueprint $table) {
            $table->string("report_status")->default("Not Managed");
            // Report status :
                    // จัดการแล้ว = Managed 
                    // ยังไม่จัดการ = Not Managed 

                    // หากจัดการแล้ว เรามี Soft delete ในตาราง reports 
                    
                    // ควรเรียงลำดับจากใหม่ไปเก่า (order by created_at DESC)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            //
            $table->dropColumn("report_status");
        });
    }
};
