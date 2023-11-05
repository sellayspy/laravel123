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
        Schema::create('t_h_juals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('d_jual_id')->constrained();
            $table->foreignId('customer_id')->constrained();
            $table->date('tglJual');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_h_juals');
    }
};
