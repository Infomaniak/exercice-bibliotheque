<?php
/**
 * Created by IntelliJ IDEA.
 * User: babdo
 * Date: 24/12/2018
 * Time: 03:24
 */
?>

@extends('layouts.master', ['title' => 'Les livres les plus consultés'])

@section('content')
    <section class="booksContainer">
        <h3 class="boldH3">Livres les plus consultés</h3>

        <div class="per4container">
            @forelse($most_viewed as $borrow)
                <div class="per4">
                    <a href="{{route('book.show', ['id'=>$borrow->get(0)->book->id])}}" class="book">
                        <img src="{{$borrow->get(0)->book->cover_url}}" alt="Livre"/>
                        <span class="bookinfos">
                        <span class="bookTitle">{{$borrow->get(0)->book->title}} - <i class="auteur">{{$borrow->get(0)->book->author->full_name}}</i></span>
                    </span>
                    </a>
                </div>
            @empty
                <p>{{ __('Désolé aucun nouveau livre n\'a été trouver.') }}</p>
            @endforelse
        </div>

    </section>
@stop
