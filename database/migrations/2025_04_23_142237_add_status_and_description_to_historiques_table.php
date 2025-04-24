<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('historiques', function (Blueprint $table) {
            $table->string('status')->default('non affecté');
            $table->text('description')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('historiques', function (Blueprint $table) {
            $table->dropColumn(['status', 'description']);
        });
    }
};
