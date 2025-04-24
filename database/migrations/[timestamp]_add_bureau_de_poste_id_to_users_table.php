<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('bureau_de_poste_id')
                  ->nullable()
                  ->constrained('bureau_de_postes')
                  ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['bureau_de_poste_id']);
            $table->dropColumn('bureau_de_poste_id');
        });
    }
};