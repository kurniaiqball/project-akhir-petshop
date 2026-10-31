<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id('id_detail');

            $table->foreignId('id_transaction')
                  ->constrained('transactions', 'id_transaction')
                  ->cascadeOnDelete();

            $table->foreignId('id_product')
                  ->constrained('products', 'id_product')
                  ->restrictOnDelete();

            $table->integer('jumlah');
            $table->decimal('harga', 12, 2);
            $table->decimal('subtotal', 12, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
    }
};