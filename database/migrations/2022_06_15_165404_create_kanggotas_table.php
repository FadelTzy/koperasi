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
        Schema::create('kanggotas', function (Blueprint $table) {
            $table->id();
            $table->string('kodea')->nullable();
            $table->string('alamat')->nullable();
            $table->string('nohp')->nullable();
            $table->string('tanggal')->nullable();
            $table->string('id_user')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('nip')->nullable();
            $table->string('simpanan')->nullable();
            $table->string('pinjaman')->nullable();
            $table->string('role')->nullable();

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
        Schema::dropIfExists('kanggotas');
    }
};
