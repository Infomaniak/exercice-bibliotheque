<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBorrowingsTable extends Migration {

	public function up()
	{
		Schema::create('borrowings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->tinyInteger('during')->unsigned()->nullable();
			$table->tinyInteger('quantity')->unsigned()->default('0');
			$table->integer('user_id')->unsigned();
			$table->integer('book_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('borrowings');
	}
}
