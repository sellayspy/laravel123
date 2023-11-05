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
        Schema::create('barangs', function (Blueprint $table) {
            $table->increments('id_barang');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategoris')->onDelete('restrict')->onUpdate('restrict');
            $table->string('kdBarang',6)->unique();
            $table->string('nmBarang',30);
            $table->string('satuan',30);
            $table->integer('hargaSatuan');
            $table->integer('stock');
            $table->date('tglExpired');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
