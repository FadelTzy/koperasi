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
        Schema::create('k_penarikans', function (Blueprint $table) {
            $table->id();
            $table->string('id_user');
            $table->string('tanggal')->nullable();
            $table->string('kode')->nullable();
            $table->string('tabungan')->nullable();
            $table->string('sisa')->nullable();
            $table->string('jumlah')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('k_penarikans');
    }
};
