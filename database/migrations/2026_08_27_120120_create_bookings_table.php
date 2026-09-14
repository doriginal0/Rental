<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('driver_id')->nullable()->onDelete('set null');
            $table->dateTime('pickup_datetime');
            $table->dateTime('return_datetime');
            $table->string('method')->nullable();
            $table->decimal('daily_rate', 10, 2);
            $table->decimal('driver_daily_rate', 10, 2)->nullable();
            $table->decimal('total_cost', 10, 2);
            $table->string('status')->default('pending'); // pending | confirmed | active | completed | cancelled
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
