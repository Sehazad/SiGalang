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
        Schema::create('pertandingans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_turnamen')->constrained('turnamens')->onDelete('cascade');
            $table->foreignId('id_tim1')->nullable()->constrained('tims')->onDelete('cascade');
            $table->foreignId('id_tim2')->nullable()->constrained('tims')->onDelete('cascade');
            $table->integer('skor_tim1')->nullable();
            $table->integer('skor_tim2')->nullable();
            $table->string('babak');
            $table->enum('status', ['pending', 'live', 'completed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pertandingans');
    }
};
