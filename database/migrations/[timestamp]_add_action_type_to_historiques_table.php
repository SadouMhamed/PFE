<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('historiques', function (Blueprint $table) {
            $table->string('action_type')->nullable();
        });
    }

    public function down()
    {
        Schema::table('historiques', function (Blueprint $table) {
            $table->dropColumn('action_type');
        });
    }
};