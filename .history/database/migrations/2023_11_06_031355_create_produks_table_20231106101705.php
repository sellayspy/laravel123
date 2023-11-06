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
        Schema::create('produks', function (Blueprint $table) { $table->increments('id_produk');
            $table->integer('id_kategori');
            $table->string('kodeProduk')->unique();
            $table->string('namaProduk');
            $table->string('merk')->nullable();
            $table->string('satuan');
            $table->integer('hargaSatuan');
            $table->integer('hargaBeli');
            $table->integer('stok');
            $table->date('tglExpired')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
