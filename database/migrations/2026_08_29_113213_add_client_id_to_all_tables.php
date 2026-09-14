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
    foreach (['cars', 'customers', 'payments', 'bookings', 'maintenances',] as $table)
        Schema::table($table, function (Blueprint $t) {
            //
            $t->foreignId('client_id')
            ->nullable()
            ->after('id')
            ->constrained('clients')
            ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    foreach (['cars', 'customers', 'payments', 'bookings', 'maintenances'] as $table)
        Schema::table($table, function (Blueprint $t) {
            //
            $t->dropConstrainedForeignId('client_id');
        });
    }
};
