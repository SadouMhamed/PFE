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
        Schema::table('historiques', function (Blueprint $table) {
            $table->unsignedBigInteger('ticket_id')->nullable()->after('reference_id');
            
            // Remove this line since the description column already exists
            // $table->text('description')->nullable()->after('new_status');
            
            // Add foreign key constraint
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('historiques', function (Blueprint $table) {
            $table->dropForeign(['ticket_id']);
            $table->dropColumn('ticket_id');
            // Remove this line since we're not adding the description column
            // $table->dropColumn('description');
        });
    }
};