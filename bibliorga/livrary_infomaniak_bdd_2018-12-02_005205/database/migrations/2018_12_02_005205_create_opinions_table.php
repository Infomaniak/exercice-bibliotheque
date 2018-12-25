<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOpinionsTable extends Migration {

	public function up()
	{
		Schema::create('opinions', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->tinyInteger('grade')->unsigned()->default('0');
			$table->text('description');
			$table->string('title', 50);
			$table->integer('user_id')->unsigned();
			$table->integer('book_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('opinions');
	}
}