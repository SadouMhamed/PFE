<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Delete all existing rows
        DB::table('bureau_de_postes')->truncate();
        
        // Add new columns
        Schema::table('bureau_de_postes', function (Blueprint $table) {
            $table->string('brigade')->nullable();
            $table->string('classe')->nullable();
            $table->string('code_commune')->nullable();
            $table->string('commune')->nullable();
            $table->string('cp')->nullable();
            $table->string('daira')->nullable();
            $table->string('etat')->nullable();
            $table->string('intitule_ar')->nullable();
            $table->string('intitule_fr')->nullable();
            $table->string('upw')->nullable();
            $table->unsignedBigInteger('upw_id')->nullable();
            $table->string('wilaya')->nullable();
            $table->unsignedBigInteger('wilaya_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bureau_de_postes', function (Blueprint $table) {
            $table->dropColumn([
                'brigade',
                'classe',
                'code_commune',
                'commune',
                'cp',
                'daira',
                'etat',
                'intitule_ar',
                'intitule_fr',
                'upw',
                'upw_id',
                'wilaya',
                'wilaya_id'
            ]);
        });
    }
};