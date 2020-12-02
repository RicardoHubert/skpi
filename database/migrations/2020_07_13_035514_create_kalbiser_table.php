<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKalbiserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kalbiser', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('nama')->nullable();
            $table->string('nim')->nullable();
            $table->string('foto')->nullable();
            $table->string('prodi')->nullable();
            $table->string('tahun_akademik')->nullable();
            $table->string('nohp')->nullable();
            $table->string('email')->nullable();
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
        Schema::dropIfExists('kalbiser');
    }
}
