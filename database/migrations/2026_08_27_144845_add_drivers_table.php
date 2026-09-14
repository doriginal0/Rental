<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->string('name');                 // e.g. Toyota
            $table->string('license_number')->nullable(); 
            $table->string('phone')->nullable();               // e.g. Corolla
            $table->date('license_expiry')->nullable();
            $table->string('description')->nullable();
            $table->decimal('driver_daily_rate', 10, 2)->nullable();   // price per day
            $table->string('status')->default('available'); // available | rented | maintenance | retired
            $table->string('image_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
