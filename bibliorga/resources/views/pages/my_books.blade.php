<?php
/**
 * Created by IntelliJ IDEA.
 * User: babdo
 * Date: 23/12/2018
 * Time: 21:10
 */
?>

@extends('layouts.master', ['title' => 'Mes livres'])

@section('content')

    @include('pages.partials.home_nav')

    <section class="per2Books">
        <div class="emprunts">
            <h3>Livres en cours d'emprunt</h3>
            <ul class="bookList">
                @forelse($borrow_not_delivred as $borrow)
                    <li class="bookElement">
                        <img class="bookElementPhoto" src="{{$borrow->book->cover_url}}"
                             alt="Photo livre">
                        <span><b>{{$borrow->book->title}}</b><i>{{$borrow->book->author->full_name}}</i></span>
                        <button type="button"
                                class="btn btn-outline-dark btn-sm"
                                onclick="event.preventDefault();document.getElementById('form{{$borrow->id}}').submit();">
                            Rendre
                        </button>
                        {{Form::open(['url'=>route('borrowing.update', ['id'=>$borrow->id]), 'method'=>'PUT', 'id'=>'form'.$borrow->id, 'class'=>'d-none'])}}
                        <input type="hidden" name="isBorrow" value="1">
                        {{Form::close()}}
                        <span>reste <b>{{$borrow->remaining_days}}</b> aujourd'hui</span>
                    </li>
                @empty
                    <p>{{__('Aucun livre en cours d\'emprunt pour le momment')}}</p>
                @endforelse
            </ul>
        </div>
        <div class="historique">
            <h3>Historique de livres rendus</h3>
            <ul class="bookList">
                @forelse($borrow_delivred as $borrow)
                    <li class="bookElement">
                        <a class="bookLink" href="{{route('book.show', ['id'=>$borrow->book->id])}}" target="_blank">
                            <img class="bookElementPhoto" src="{{$borrow->book->cover_url}}"
                                 alt="Photo livre">
                            <span><b>{{$borrow->book->title}}</b><i>{{$borrow->book->author->full_name}}</i></span>
                            <br>
                            <span>Emprunté {{$borrow->created_at->formatLocalized('le %d %B %Y')}}</span>
                            <span>Rendu {{$borrow->updated_at->formatLocalized('le %d %B %Y')}}</span>
                        </a>
                    </li>
                @empty
                    <p>{{__('Vous n\'avez pas encore rendu de livre')}}</p>
                @endforelse
            </ul>
        </div>
    </section>
@stop
