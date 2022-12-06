<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('id_penerbit')->nullable();
            $table->string('judul');
            $table->integer('tahun_terbit');
            $table->string('tempat_terbit');
            $table->integer('halaman');
            $table->string('ddc')->nullable(); 
            $table->string('isbn')->nullable(); 
            $table->string('no_rak')->nullable();
            $table->integer('stok')->default(0);
            $table->string('keterangan')->nullable();

            $table->foreign('id_penerbit')->references('id_penerbit')->on('publishers')->nullable()->constrained()->onDelete('set null');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};
