<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowingsTable extends Migration
{

    public function up()
    {
        Schema::create('borrowings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->tinyInteger('during')->unsigned()->nullable();
            $table->tinyInteger('quantity')->unsigned()->default('0');
            $table->integer('user_id')->unsigned();
            $table->integer('book_id')->unsigned();
            $table->boolean('isBorrow')->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('borrowings');
    }
}
