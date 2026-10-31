<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id('id_pet');

            $table->foreignId('id_customer')
                  ->constrained('customers', 'id_customer')
                  ->cascadeOnDelete();

            $table->string('nama_pet', 100);
            $table->string('jenis', 50);
            $table->string('ras', 50)->nullable();

            $table->enum('jenis_kelamin', [
                'Jantan',
                'Betina'
            ]);

            $table->unsignedTinyInteger('umur_tahun')->nullable();
            $table->unsignedTinyInteger('umur_bulan')->nullable();
            
            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};