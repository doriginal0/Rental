<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->nullable()->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->string('method'); // cash | card | bank_transfer | online
            $table->string('status')->default('pending'); // pending | completed | refunded | failed
            $table->string('reference')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->string('type')->default('income');      // NEW
            $table->string('description')->nullable();      // NEW
            $table->timestamps();
        });
    }

    public function down(): void
    {
        // Restore old schema if rolled back
        Schema::dropIfExists('payments');
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->string('method');
            $table->string('status')->default('pending');
            $table->string('reference')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }
};