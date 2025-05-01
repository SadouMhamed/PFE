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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'bureau_de_poste_id')) {
                $table->unsignedBigInteger('bureau_de_poste_id')->nullable();
                $table->foreign('bureau_de_poste_id')->references('id')->on('bureau_de_postes')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['bureau_de_poste_id']);
            $table->dropColumn('bureau_de_poste_id');
        });
    }
};