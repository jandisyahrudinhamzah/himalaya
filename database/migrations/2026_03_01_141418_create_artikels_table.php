<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/xxxx_xx_xx_create_artikels_table.php
public function up()
{
    Schema::create('artikels', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->text('konten');
        $table->string('gambar')->nullable();
        $table->string('slug')->unique();
        $table->enum('status', ['draft', 'published'])->default('draft');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikels');
    }
};
