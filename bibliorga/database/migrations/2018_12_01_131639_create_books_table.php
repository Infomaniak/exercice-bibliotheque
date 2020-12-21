<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{

    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->date('publication');
            $table->string('ref', 30);
            $table->longText('description');
            $table->string('image', 100)->nullable();
            $table->integer('quantity');
            $table->timestamps();
            $table->integer('category_id')->unsigned();
            $table->integer('author_id')->unsigned();
        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
}
