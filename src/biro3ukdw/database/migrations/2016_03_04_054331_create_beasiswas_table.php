<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeasiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beasiswas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kategori');
            $table->string('sumber');
            $table->integer('jumlah');
            $table->string('header_pic');
            $table->timestamps();
            $table->timestamps('deadline_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('beasiswas');
    }
}
