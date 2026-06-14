<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Fix column names in bookings: id_customer→id_user, tanggal_booking→tanggal_main
     * Normalize users role enum values.
     */
    public function up(): void
    {
        // Fix bookings table columns
        Schema::table('bookings', function (Blueprint $table) {
            // Rename id_customer to id_user
            if (Schema::hasColumn('bookings', 'id_customer')) {
                $table->renameColumn('id_customer', 'id_user');
            }
            // Rename tanggal_booking to tanggal_main
            if (Schema::hasColumn('bookings', 'tanggal_booking')) {
                $table->renameColumn('tanggal_booking', 'tanggal_main');
            }
        });

        // Normalize users role enum values
        if (config('database.default') !== 'sqlite') {
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'karyawan', 'customer') NOT NULL DEFAULT 'customer'");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            if (Schema::hasColumn('bookings', 'id_user')) {
                $table->renameColumn('id_user', 'id_customer');
            }
            if (Schema::hasColumn('bookings', 'tanggal_main')) {
                $table->renameColumn('tanggal_main', 'tanggal_booking');
            }
        });
    }
};
