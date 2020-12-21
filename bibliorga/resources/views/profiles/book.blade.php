<?php
/**
 * Created by IntelliJ IDEA.
 * User: BOINAIDI Abdourahamane
 * Date: 20/12/2018
 * Time: 23:27
 */
?>

@extends('layouts.master', ['title'=> 'Livre'])

@section('content')
    <section class="bookDetails">
        <img class="bookPhoto" src="{{$book->cover_url}}" alt="Cover Book"/>
        <div class="details">
            <span><b>{{$book->title}}</b> <i>ref: </i>{{$book->ref}}</span>
            <span class="infos">{{$book->category->name}}</span>
            <span><i>Par: </i><a class="authorLink"
                                 href="{{route('author.show', ['id'=>$book->author->id])}}">{{$book->author->full_name}}</a></span>
            <span>Publié le {{\Carbon\Carbon::createFromFormat('Y-m-d', $book->publication)->formatLocalized('%d %B %Y')}}</span>
            <span class="desc">{{$book->description}}</span>
            <span><i>Quantité disponible: </i>{{$book->quantity}}</span>
            <br>
            @if($book->quantity > 0)
                {{Form::open(['url'=>route('borrowing.store'), 'method'=>'POST'])}}
                <input type="hidden" name="book_id" value="{{$book->id}}">
                <div class="input-group mb-3 col-xl-4 col-md-5 col-sm-5 col-5 pl-0">
                    <input name="during" value="5" min="0" type="number" class="form-control"
                           placeholder="Recipient's username" aria-label="Recipient's username"
                           aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <div class="input-group-text" id="basic-addon2">jours</div>
                    </div>
                </div>
                <input type="submit" class="btn btn-outline-primary btn-lg" value="Emprunter"/>
                {{Form::close()}}
            @endif
        </div>
        <div class="feedbacks">
            <span class="headFeedback">
                {{$book->opinions == null ? 0 :$book->opinions->count()}}
                Avis reçus | {{$book->opinions == null ? 0 :round($book->opinions->avg('grade'), 1)}}/5
            </span>
            @if ($book->opinions)
                @foreach($book->opinions as $opinion)
                    <div class="media border p-3">
                        <div class="mr-3">
                            <img src="{{$opinion->user->profile_image}}" alt="{{$opinion->user->full_name}}"
                                 class="mt-3 rounded-circle"
                                 style="width:60px;">
                            <span class="nameFeed">{{$opinion->user->full_name}}</span>
                        </div>
                        <div class="media-body">
                            <h4 class="mb-0">{{$opinion->title}}
                                <small class="d-block mb-0">
                                    <i>
                                        Posté le {{$opinion->created_at->formatLocalized('%d %B %Y à %R')}}
                                    </i>
                                </small>
                            </h4>
                            <p>{{ $opinion->description }}<span class="note"><i>Note:</i>{{$opinion->grade}}/5</span>
                            </p>
                            @if(auth()->user() && $opinion->user->id == auth()->user()->id)
                                <button
                                    class="btn btn-outline-success"
                                    data-toggle="modal"
                                    data-target="#edit_opinion_modal"
                                    onclick="complete_edit_opinion_modal({{$opinion}})"
                                >{{__('Modifier')}}
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <div class="media border p-3">
                    <div class="media-body">
                        <p>{{__('Ce livre a aucun avis, soyez le premier à ajouter')}}</p>
                    </div>
                </div>
            @endif

            <div class="media border p-3">
                <div class="media-body">
                    {{Form::open(['url' => route('opinion.store'), 'method'=>'POST'])}}
                    <div class="form-group row">
                        <div class="col-md-12">
                            {!! Form::control('text', $errors, 'title', 'Votre titre, par exemple: "Excellent"') !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            {!! Form::control('number', $errors, 'grade', 'Entrez une valeur comprise entre 0 et 5', ['min'=>0, 'max'=>5]) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            {!! Form::control('textarea', $errors, 'description', 'Votre avis...', ['style'=>'resize:none;']) !!}
                        </div>
                    </div>
                    <input type="hidden" name="book_id" value="{{$book->id}}">
                    <div class="form-group row mb-0">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Poster') }}
                            </button>
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </section>

    @include('modals.edit_opinion')
@stop

@section('scripts')
    <script>
        function complete_edit_opinion_modal(opinion) {
            $('#edit_opinion_modal_form').attr('action', `/opinion/${opinion.id}`);
            $('#edit_opinion_modal_title').val(opinion.title);
            $('#edit_opinion_modal_grade').val(opinion.grade);
            $('#edit_opinion_modal_description').val(opinion.description);
            $('#edit_opinion_modal_book_id').val(opinion.book_id);
        }
    </script>
@stop
