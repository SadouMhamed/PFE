<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('bureau_de_postes')) {
            Schema::create('bureau_de_postes', function (Blueprint $table) {
                $table->id();
                $table->string('code');
                $table->string('intitule_fr');
                $table->string('intitule_ar')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('bureau_de_postes');
    }
};