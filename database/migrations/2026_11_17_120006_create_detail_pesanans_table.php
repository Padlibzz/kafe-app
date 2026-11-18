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
        Schema::create('detail_pesanans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pesanan');
            $table->foreign('id_pesanan')->references('id')->on('pesanans');
            $table->unsignedBigInteger('id_menu');
            $table->foreign('id_menu')->references('id_menu')->on('menus');
            $table->integer('jumlah')->default(1);
            $table->decimal('subtotal', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pesanans');
    }
};
