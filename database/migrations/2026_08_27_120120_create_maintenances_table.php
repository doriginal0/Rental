<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained()->onDelete('cascade');
            $table->date('scheduled_date');
            $table->date('completed_date')->nullable();
            $table->string('type'); // oil_change | tire_replacement | brake_service | general | other
            $table->text('description')->nullable();
            $table->decimal('cost', 10, 2)->default(0);
            $table->string('status')->default('scheduled'); // scheduled | in_progress | completed
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
