<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('historiques', function (Blueprint $table) {
            if (!Schema::hasColumn('historiques', 'status')) {
                $table->string('status')->nullable();
            }
            if (!Schema::hasColumn('historiques', 'description')) {
                $table->text('description')->nullable();
            }
            if (!Schema::hasColumn('historiques', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable();
                $table->foreign('user_id')->references('id')->on('users');
            }
        });
    }

    public function down()
    {
        Schema::table('historiques', function (Blueprint $table) {
            if (Schema::hasColumn('historiques', 'user_id')) {
                $table->dropForeign(['user_id']);
            }
            $table->dropColumnIfExists('status');
            $table->dropColumnIfExists('description');
            $table->dropColumnIfExists('user_id');
        });
    }
};
