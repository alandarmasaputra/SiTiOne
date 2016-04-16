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
            $table->string('name');
            $table->string('kategori');
            $table->string('sumber');
            $table->integer('jumlah');
            $table->string('header_pic');
            $table->timestamp('deadline_date')->nullable();
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
        Schema::drop('beasiswas');
    }
}
