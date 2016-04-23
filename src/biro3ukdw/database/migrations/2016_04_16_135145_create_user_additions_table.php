<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAdditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_additions', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('user_id');
			$table->string('display_pic');
            $table->string('display_name');
			$table->string('jabatan');
			$table->string('email');
			$table->string('phone');
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
        Schema::drop('user_additions');
    }
}
