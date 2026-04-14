<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  // database/migrations/xxxx_xx_xx_create_anggotas_table.php
public function up()
{
    Schema::create('anggotas', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('email')->unique();
        $table->string('nim')->nullable();
        $table->string('no_hp')->nullable();
        $table->string('foto')->nullable();
        $table->ENUM('jabatan', ['ketua', 'waketum', 'sekretaris', 'bendahara', 'peralatan', 'anggota'])->default('anggota');
        $table->enum('status', ['aktif', 'alumni', 'nonaktif'])->default('aktif');
        $table->text('bio')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};
