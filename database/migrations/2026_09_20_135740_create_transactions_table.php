<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('id_transaction');

            $table->foreignId('id_customer')
                  ->constrained('customers', 'id_customer')
                  ->restrictOnDelete();

            $table->dateTime('tanggal')
                  ->useCurrent();

            $table->decimal('total', 12, 2)
                  ->default(0);

            $table->enum('status', [
                'Pending',
                'Diproses',
                'Selesai',
                'Dibatalkan'
            ])->default('Pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};