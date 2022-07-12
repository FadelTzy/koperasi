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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('kode')->nullable();
            $table->string('role')->comment('1 admin 2 petugas 3 anggota 4 pengawas');
            $table->string('username');
            $table->string('foto')->nullable();
            $table->string('jk')->nullable();
            $table->string('status')->nullable()->comment('1 akrif 2 non aktif');
            $table->string('email')->unique();
            $table->string('tanggal_masuk')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
