<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fleet_id')->nullable()->constrained()->nullOnDelete();
            $table->string('make');                 // e.g. Toyota
            $table->string('model');                // e.g. Corolla
            $table->year('year');
            $table->string('license_plate')->unique();
            $table->string('color')->nullable();
            $table->string('transmission')->default('automatic'); // automatic | manual
            $table->integer('seats')->default(5);
            $table->decimal('daily_rate', 10, 2);   // price per day
            $table->string('status')->default('available'); // available | rented | maintenance | retired
            $table->string('image_url')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
