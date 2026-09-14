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
       Schema::create('fleets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')
        ->constrained('clients')
        ->cascadeOnDelete();
            $table->string('fleet_name');
            $table->string('category')->nullable();
            $table->string('description')->nullable();
            $table->unique(['client_id', 'fleet_name']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::dropIfExists('fleets');
    }
};
