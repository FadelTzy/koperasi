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
        Schema::create('kt_simpans', function (Blueprint $table) {
            $table->id();
            $table->string('id_user');
            $table->string('kode_simpan')->nullable();
            $table->string('tanggal')->nullable();
            $table->string('id_simpan')->nullable();
            $table->string('nama_simpanan')->nullable();
            $table->string('total_simpanan')->nullable();
            $table->string('status')->nullable()->comment('1 disimpan 2 diambil');
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
        Schema::dropIfExists('kt_simpans');
    }
};
