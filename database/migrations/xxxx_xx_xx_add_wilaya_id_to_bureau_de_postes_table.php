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
        Schema::table('bureau_de_postes', function (Blueprint $table) {
            // Add wilaya_id as foreign key if it doesn't exist
            if (!Schema::hasColumn('bureau_de_postes', 'wilaya_id')) {
                $table->unsignedBigInteger('wilaya_id')->nullable();
                $table->foreign('wilaya_id')->references('id')->on('wilayas')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bureau_de_postes', function (Blueprint $table) {
            // Drop foreign key and column
            $table->dropForeign(['wilaya_id']);
            $table->dropColumn('wilaya_id');
        });
    }
};