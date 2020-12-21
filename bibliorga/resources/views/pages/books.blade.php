<?php
/**
 * Created by IntelliJ IDEA.
 * User: babdo
 * Date: 23/12/2018
 * Time: 17:45
 */
?>

@extends('layouts.master', ['title' => 'Tous les livres'])

@section('content')
    <section class="booksContainer">
        <h3 class="boldH3">Tous les livres</h3>
        @include('pages.partials.show_books')
    </section>
@stop
