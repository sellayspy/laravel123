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
        Schema::create('h_juals', function (Blueprint $table) {
            $table->Increments('id_hjual');
            $table->foreignId('id_customer')->references('id_customer')->on('customers')->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('id_djual')->references('id_djual')->on('d_juals')->onDelete('restrict')->onUpdate('restrict');
            $table->date('tglJual');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('h_juals');
    }
};
