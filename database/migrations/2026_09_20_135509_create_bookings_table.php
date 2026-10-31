<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('id_booking');

            $table->foreignId('id_customer')
                  ->constrained('customers', 'id_customer')
                  ->cascadeOnDelete();

            $table->foreignId('id_pet')
                  ->constrained('pets', 'id_pet')
                  ->cascadeOnDelete();

            $table->foreignId('id_service')
                  ->constrained('services', 'id_service')
                  ->restrictOnDelete();

            $table->date('tanggal_booking');
            $table->time('jam_booking');

            $table->enum('status', [
                'Menunggu',
                'Dikonfirmasi',
                'Selesai',
                'Dibatalkan'
            ])->default('Menunggu');

            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};