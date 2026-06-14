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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_booking')->nullable()->constrained('bookings')->onDelete('cascade');
            $table->foreignId('id_turnamen')->nullable()->constrained('turnamens')->onDelete('cascade');
            $table->dateTime('tanggal_bayar')->nullable();
            $table->decimal('total_bayar', 10, 2);
            $table->string('metode_bayar')->default('qris');
            $table->enum('status_bayar', ['pending', 'success'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
