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
        Schema::create('historiques', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // 'ticket' or 'demande'
            $table->unsignedBigInteger('reference_id'); // ticket_id or demande_id
            $table->string('old_status')->nullable();
            $table->string('new_status');
            $table->unsignedBigInteger('updated_by'); // user who triggered the change
            $table->timestamp('created_at')->useCurrent();
        
            // Optionally add foreign keys:
            // $table->foreign('updated_by')->references('id')->on('users');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historiques');
    }
};
