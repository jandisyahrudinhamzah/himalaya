<?php
// database/migrations/xxxx_create_galeris_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('galeris', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->nullable();
            $table->string('foto');
            $table->enum('kategori', ['kegiatans', 'pendakian', 'outing', 'lainnya'])->default('kegiatans');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
            
            $table->index('kategori');
        });
    }

    public function down()
    {
        Schema::dropIfExists('galeris');
    }
};

