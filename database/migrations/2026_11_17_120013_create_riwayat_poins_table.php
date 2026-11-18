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
        Schema::create('riwayat_poins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_customer');
            $table->foreign('id_customer')->references('id_customer')->on('customers');
            $table->unsignedBigInteger('id_aturan_loyalty')->nullable();
            $table->foreign('id_aturan_loyalty')->references('id')->on('aturan_loyalties');
            $table->unsignedBigInteger('id_reward')->nullable();
            $table->foreign('id_reward')->references('id')->on('rewards');
            $table->enum('tipe', ['tambah', 'kurang']);
            $table->integer('poin');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_poins');
    }
};
