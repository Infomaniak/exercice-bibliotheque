<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForeignKeys extends Migration
{

    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('books', function (Blueprint $table) {
            $table->foreign('author_id')->references('id')->on('authors')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('borrowings', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('borrowings', function (Blueprint $table) {
            $table->foreign('book_id')->references('id')->on('books')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('opinions', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('opinions', function (Blueprint $table) {
            $table->foreign('book_id')->references('id')->on('books')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('favorites', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('favorites', function (Blueprint $table) {
            $table->foreign('book_id')->references('id')->on('books')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('loves', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('loves', function (Blueprint $table) {
            $table->foreign('book_id')->references('id')->on('books')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropForeign('books_category_id_foreign');
        });
        Schema::table('books', function (Blueprint $table) {
            $table->dropForeign('books_author_id_foreign');
        });
        Schema::table('borrowings', function (Blueprint $table) {
            $table->dropForeign('borrowings_user_id_foreign');
        });
        Schema::table('borrowings', function (Blueprint $table) {
            $table->dropForeign('borrowings_book_id_foreign');
        });
        Schema::table('opinions', function (Blueprint $table) {
            $table->dropForeign('opinions_user_id_foreign');
        });
        Schema::table('opinions', function (Blueprint $table) {
            $table->dropForeign('opinions_book_id_foreign');
        });
        Schema::table('favorites', function (Blueprint $table) {
            $table->dropForeign('favorites_user_id_foreign');
        });
        Schema::table('favorites', function (Blueprint $table) {
            $table->dropForeign('favorites_book_id_foreign');
        });
        Schema::table('loves', function (Blueprint $table) {
            $table->dropForeign('loves_user_id_foreign');
        });
        Schema::table('loves', function (Blueprint $table) {
            $table->dropForeign('loves_book_id_foreign');
        });
    }
}
