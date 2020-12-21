<?php
/**
 * Created by IntelliJ IDEA.
 * User: BOINAIDI Abdourahamane
 * Date: 20/12/2018
 * Time: 23:27
 */
?>

@extends('layouts.master', ['title'=> 'Auteur'])

@section('content')
    <section class="author">
        <img class="authorPhoto" src="{{$author->profile_image}}" alt="Photo Glenn Cooper">
        <h4 class="authorName">{{$author->full_name}}</h4>
        <span class="biography">
        {!! str_replace(["\r\n", "\n", "\r"], "<br/>", $author->biography) !!}
        </span>
    </section>
    <section class="booksContainer">
        <h3 class="boldH3">Œuvres</h3>
        <div class="per4container">
            @forelse($author->books as $book)
                <div class="per4">
                    <a href="{{route('book.show', ['id'=>$book->id])}}" class="book">
                        <img src="{{$book->cover_url}}" alt="Livre"/>
                        <span class="bookinfos">
                        <span class="bookTitle">{{$book->title}} - <i class="auteur">{{$author->full_name}}</i></span>
                    </span>
                    </a>
                </div>
            @empty
                <p>Pas de livre</p>
            @endforelse
        </div>
    </section>
@stop
