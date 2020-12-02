<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKompetisiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kompetisiinternal', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable;
            $table->string('poster')->nullable;
            $table->string('nama_kompetisi');
            $table->string('jenis_kompetisi');
            $table->string('ormawa_id')->nullable();
            $table->string('url')->nullable();
            $table->string('sertifikat')->nullable();
            $table->string('file_sertifikat')->nullable();
            $table->string('skala')->nullable();
            $table->string('pencapaian')->nullable();
            $table->string('nama_kegiatan')->nullable();
            $table->string('tanggal_kegiatan')->nullable();
            $table->string('penyelenggara')->nullable();
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
        Schema::dropIfExists('kompetisiinternal');
    }
}
