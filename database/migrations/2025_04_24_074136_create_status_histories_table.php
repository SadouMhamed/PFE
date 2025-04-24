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
        Schema::create('status_histories', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // 'ticket' ou 'demande'
            $table->unsignedBigInteger('reference_id'); // id de la demande ou ticket
            $table->string('old_status')->nullable();
            $table->string('new_status');
            $table->text('description')->nullable(); // 🆕
            $table->unsignedBigInteger('updated_by'); // user_id
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_histories');
    }
};
