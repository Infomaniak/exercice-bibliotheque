<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAuthorsTable extends Migration {

	public function up()
	{
		Schema::create('authors', function(Blueprint $table) {
			$table->increments('id');
			$table->string('firstname', 100);
			$table->string('lastname', 100);
			$table->text('biography');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('authors');
	}
}