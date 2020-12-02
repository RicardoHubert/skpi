<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPenyelenggaraToTableSkpi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('skpi', function (Blueprint $table) {
            // $table->string("penyelenggara", 125);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('skpi', function (Blueprint $table) {
            // $table->dropColumn("penyelenggara");
        });
    }
}
