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
        Schema::create('book_loans', function (Blueprint $table) {
            $table->string('id_peminjaman')->primary();            
            $table->string('id_buku');
            $table->string('id_user');
            $table->timestamp('tanggal_peminjaman')->nullable();
            $table->timestamp('tenggat_pengembalian')->nullable();
            $table->timestamp('tanggal_pengembalian')->nullable();

            $table->foreign('id_buku')->references('id')->on('books')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_loans');
    }
};
