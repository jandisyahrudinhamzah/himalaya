<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_kegiatans_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi');
            $table->date('tanggal');
            $table->string('lokasi');
            $table->unsignedInteger('kuota')->nullable();
            $table->enum('status', ['Upcoming', 'Ongoing', 'Selesai'])->default('Upcoming');
            $table->string('foto')->nullable();
            $table->timestamps();
            
            $table->index(['status', 'tanggal']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('kegiatans');
    }
};