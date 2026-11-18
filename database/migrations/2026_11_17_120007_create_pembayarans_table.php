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
            $table->unsignedBigInteger('id_pesanan');
            $table->foreign('id_pesanan')->references('id')->on('pesanans');
            $table->enum('metode', ['tunai', 'kartu', 'transfer']);
            $table->decimal('nominal', 15, 2);
            $table->enum('status', ['pending', 'sukses', 'gagal']);
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
