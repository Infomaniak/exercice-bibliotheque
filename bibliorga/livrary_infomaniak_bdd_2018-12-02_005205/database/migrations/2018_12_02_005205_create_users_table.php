<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->string('firstname', 100);
			$table->string('lastname', 100);
			$table->string('email', 150);
			$table->string('password', 150);
			$table->enum('sex', array('male', 'female'));
			$table->enum('role', array('user', 'librarian', 'admin'));
			$table->boolean('verified')->default(0);
			$table->string('attachment', 150)->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('users');
	}
}