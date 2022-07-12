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
        Schema::create('kt_pinjams', function (Blueprint $table) {
            $table->id();
            $table->string('id_user');
            $table->string('kode_pinjam')->nullable();
            $table->string('tanggal')->nullable();
            $table->string('id_pinjam')->nullable();
            $table->string('nama_pinjam')->nullable();
            $table->string('jumlah_pinjam')->nullable();
            $table->string('jatuh_tempo')->nullable();
            $table->string('lama_angsuran')->nullable();
            $table->string('status')->nullable()->comment('1 disetujui 2 diajukan');
            $table->string('status_pinjam')->nullable()->comment('1 lunas 2 belumlunas');
            $table->string('bunga')->nullable();
            $table->string('biaya_angsuran_pokok')->nullable();
            $table->string('biaya_angsuran_bunga')->nullable();
            $table->string('tanggal_diterima')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kt_pinjams');
    }
};
