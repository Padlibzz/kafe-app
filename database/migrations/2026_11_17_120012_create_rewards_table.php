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
        Schema::create('rewards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_customer');
            $table->foreign('id_customer')->references('id_customer')->on('customers');
            $table->unsignedBigInteger('id_aturan_loyalty');
            $table->foreign('id_aturan_loyalty')->references('id')->on('aturan_loyalties');
            $table->integer('poin_digunakan');
            $table->enum('status', ['pending', 'digunakan', 'kadaluarsa'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rewards');
    }
};
