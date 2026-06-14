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
        Schema::create('turnamens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_admin')->nullable()->constrained('users')->onDelete('set null');
            $table->string('nama_turnamen');
            $table->integer('jumlah_tim');
            $table->decimal('biaya_pendaftaran', 10, 2);
            $table->enum('status_pengajuan', ['pending', 'approved', 'rejected', 'active', 'completed'])->default('pending');
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turnamens');
    }
};
