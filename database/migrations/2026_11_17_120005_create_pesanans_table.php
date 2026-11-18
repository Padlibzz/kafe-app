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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_customer')->nullable();
            $table->foreign('id_customer')->references('id_customer')->on('customers');
            $table->unsignedBigInteger('id_meja')->nullable();
            $table->foreign('id_meja')->references('id_meja')->on('mejas');
            $table->enum('status', ['pending', 'dibuat', 'dibayar', 'diproses', 'selesai', 'dibatalkan']);
            $table->decimal('total_harga', 15, 2);
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
