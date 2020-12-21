<?php
/**
 * Created by IntelliJ IDEA.
 * User: babdo
 * Date: 23/12/2018
 * Time: 18:09
 */
?>

@extends('layouts.master', ['title' => 'Tous les nouveaux livres'])

@section('content')
    <section class="booksContainer">
        <h3 class="boldH3">Nouveautés</h3>
        @include('pages.partials.show_books')
    </section>
@stop
