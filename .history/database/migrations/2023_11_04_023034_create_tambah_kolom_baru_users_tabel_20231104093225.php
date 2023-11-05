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
        Schema::create('tambah_kolom_baru_users_tabel', function (Blueprint $table) {
            $table->string('foto')->nullable();
            $table->tinyInteger('level')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tambah_kolom_baru_users_tabel') ;
    }
};
