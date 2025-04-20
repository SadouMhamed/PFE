<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('demandes', 'date_de_demande')) {
            Schema::table('demandes', function (Blueprint $table) {
                $table->dropColumn('date_de_demande');
            });
        }
    }

    public function down(): void
    {
        if (!Schema::hasColumn('demandes', 'date_de_demande')) {
            Schema::table('demandes', function (Blueprint $table) {
                $table->timestamp('date_de_demande')->nullable();
            });
        }
    }
};
