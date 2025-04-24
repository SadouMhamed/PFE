<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('tickets')) {
            Schema::create('tickets', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('demande_id');
                $table->unsignedBigInteger('technicien_id');
                $table->string('status')->default('non traité');
                $table->text('description')->nullable();
                $table->text('observation')->nullable();
                $table->timestamps();

                $table->foreign('demande_id')->references('id')->on('demandes')->onDelete('cascade');
                $table->foreign('technicien_id')->references('id')->on('users');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('tickets');
    }
};