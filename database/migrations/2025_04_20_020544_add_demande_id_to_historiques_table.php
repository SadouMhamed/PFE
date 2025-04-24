<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('historiques', 'demande_id')) {
            Schema::table('historiques', function (Blueprint $table) {
                $table->unsignedBigInteger('demande_id')->nullable();
                $table->foreign('demande_id')->references('id')->on('demandes')->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        Schema::table('historiques', function (Blueprint $table) {
            $table->dropForeign(['demande_id']);
            $table->dropColumn('demande_id');
        });
    }
};
