<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('status_histories', function (Blueprint $table) {
            if (!Schema::hasColumn('status_histories', 'trackable_type')) {
                $table->string('trackable_type')->nullable();
            }
            // Ajoute d'autres champs si nécessaire
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('status_histories', function (Blueprint $table) {
            if (Schema::hasColumn('status_histories', 'trackable_type')) {
                $table->dropColumn('trackable_type');
            }
        });
    }
};
