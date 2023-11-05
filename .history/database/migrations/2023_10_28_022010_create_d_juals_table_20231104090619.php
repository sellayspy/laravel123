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
        Schema::create('d_juals', function (Blueprint $table) {
            $table->increments('id_djual');
            $table->string('noTransaksi',11)->unique();
            $table->foreignId('id_barang')->references('id_barang')->on('barangs')->onDelete('restrict')->onUpdate('restrict');
            $table->integer('qty');
            $table->decimal('hargaJual');
            $table->decimal('totalHarga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('d_juals');
    }
};
