<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('historiques', function (Blueprint $table) {
            $table->string('status')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::table('historiques', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['status', 'description', 'user_id']);
        });
    }
};
