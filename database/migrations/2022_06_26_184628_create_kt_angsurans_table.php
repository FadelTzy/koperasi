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
        Schema::create('kt_angsurans', function (Blueprint $table) {
            $table->id();
            $table->string('id_user');
            $table->string('id_pinjaman')->nullable();
            $table->string('tanggal')->nullable();
            $table->string('angsuran')->nullable();
            $table->string('pokok')->nullable();
            $table->string('bunga')->nullable();
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
        Schema::dropIfExists('kt_angsurans');
    }
};
