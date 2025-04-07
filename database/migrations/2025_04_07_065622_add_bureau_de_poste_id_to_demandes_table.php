<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('demandes', function (Blueprint $table) {
            $table->unsignedBigInteger('bureau_de_poste_id')->nullable();
            
            $table->foreign('bureau_de_poste_id', 'demandes_bdp_foreign')
                  ->references('id')
                  ->on('Bureau_de_poste')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('demandes', function (Blueprint $table) {
            $table->dropForeign('demandes_bdp_foreign');
            $table->dropColumn('bureau_de_poste_id');
        });
    }
};