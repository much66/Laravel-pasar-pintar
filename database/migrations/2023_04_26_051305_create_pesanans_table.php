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
            $table->foreignId('user_id');
            $table->foreignId('product_id');
            $table->decimal('price_total', 8, 0);
            $table->text('address');
            $table->string('no_telp');
            $table->string('metode');
            $table->integer('kuantitas');
            $table->decimal('price', 10, 2);
            $table->string('catatan')->nullable();
            $table->string('status')->default('sedang diproses');
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
