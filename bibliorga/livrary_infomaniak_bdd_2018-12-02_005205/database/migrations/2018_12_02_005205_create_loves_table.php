<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLovesTable extends Migration {

	public function up()
	{
		Schema::create('loves', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('user_id')->unsigned();
			$table->integer('book_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('loves');
	}
}