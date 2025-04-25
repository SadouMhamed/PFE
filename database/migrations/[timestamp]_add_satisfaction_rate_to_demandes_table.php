<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('demandes', function (Blueprint $table) {
            $table->decimal('satisfaction_rate', 3, 1)
                  ->nullable()
                  ->check('satisfaction_rate >= 0 AND satisfaction_rate <= 10');
        });
    }

    public function down()
    {
        Schema::table('demandes', function (Blueprint $table) {
            $table->dropColumn('satisfaction_rate');
        });
    }
};