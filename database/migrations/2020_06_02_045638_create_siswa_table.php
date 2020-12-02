<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ormawa', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('logo_ormawa');
            $table->string('nama_ormawa');
            $table->string('kategori_ormawa');
            $table->string('visi');
            $table->string('misi');
            $table->string('email');
            $table->string('bg_ormawa');
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
        Schema::dropIfExists('ormawa');
    }
}
