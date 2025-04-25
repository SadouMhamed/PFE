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
        Schema::table('status_histories', function (Blueprint $table) {
            //
            $table->string('old_status')->nullable();
            $table->string('new_status')->nullable();
            $table->string('changed_by')->nullable();
            $table->text('comments')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('status_histories', function (Blueprint $table) {
            //
            $table->dropColumn(['old_status', 'new_status', 'changed_by', 'comments']);
        });
    }
};
