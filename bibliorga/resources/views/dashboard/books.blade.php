<?php
/**
 * Created by IntelliJ IDEA.
 * User: babdo
 * Date: 22/12/2018
 * Time: 16:27
 */
?>

@extends('layouts.dashboard', ['title' => 'Gestion des livres'])

@section('content')
    <div class="row" ng-controller="bookController">
        {{-- Book --}}
        <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="x_panel tile overflow_hidden">
                <div class="x_title">
                    <h2>Gestion des livres</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="overflow: auto">
                    <table class="table table-hover">
                        <tr>
                            <th>id</th>
                            <th>titre</th>
                            <th>date de publication</th>
                            <th>référence</th>
                            <th>quantité</th>
                            <th>categorie</th>
                            <th>auteur</th>
                            <th>action</th>
                        </tr>
                        @foreach($books as $book)
                            <tr>
                                <td>{{$book->id}}</td>
                                <td>{{$book->title}}</td>
                                <td>{{\Carbon\Carbon::createFromFormat('Y-m-d', $book->publication)->format('d/m/Y')}}</td>
                                <td>{{$book->ref}}</td>
                                <td>{{$book->quantity}}</td>
                                <td>{{$book->category->name}}</td>
                                <td>{{$book->author->full_name}}</td>
                                <td>
                                    <a href="{{route('book.show', ['id'=>$book->id])}}" class="btn-sm btn-primary"><span
                                            class="glyphicon glyphicon-eye-open"></span></a>
                                    <a href="#"
                                       class="btn-sm btn-warning"
                                       ng-click="showMyModal({{$book}})"
                                       data-toggle="modal" data-target="#book_show_modal"
                                    >
                                        <span
                                            class="glyphicon glyphicon-pencil"></span></a>
                                    <a href="#" class="btn-sm btn-danger"
                                       onclick="event.preventDefault(); document.getElementById('bookDelete{{$book->id}}').submit();"
                                    >
                                        <span
                                            class="glyphicon glyphicon-trash">
                                        </span>
                                    </a>
                                    {{ Form::open([
                                    'url'=>route('book.destroy', ['id'=>$book->id]),
                                    'method'=>'DELETE',
                                    'id' => 'bookDelete'.$book->id,
                                    ])}}
                                    {{Form::close()}}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {{$books->links()}}
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel tile overflow_hidden">
                <div class="x_title">
                    <h2>ajoutre un livre</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    {{Form::open(['url'=>route('book.store'), 'method'=>'POST', 'enctype' => "multipart/form-data"])}}
                    <div class="form-group row">
                        <label for="photo" class="col-md-4 col-form-label text-md-right">{{ __('Photo') }}</label>
                        <div class="col-md-6">
                            {!! Form::control('file', $errors, 'photo', 'Votre image...') !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Titre') }}</label>
                        <div class="col-md-6">
                            {!! Form::control('text', $errors, 'title', 'Titre...') !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="publication"
                               class="col-md-4 col-form-label text-md-right">{{ __('Date de publication') }}</label>
                        <div class="col-md-6">
                            {!! Form::control('date', $errors, 'publication', 'Titre...') !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="ref"
                               class="col-md-4 col-form-label text-md-right">{{ __('Numéro de référence') }}</label>
                        <div class="col-md-6">
                            {!! Form::control('text', $errors, 'ref', 'Référence...') !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('Quantité') }}</label>
                        <div class="col-md-6">
                            {!! Form::control('number', $errors, 'quantity', 'Quantité...') !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="category_id"
                               class="col-md-4 col-form-label text-md-right">{{ __('Catégorie') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" id="category_id" name="category_id">
                                <option disabled>Choisissez une catégorie...</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="author_id" class="col-md-4 col-form-label text-md-right">{{ __('Auteur') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" id="author_id" name="author_id">
                                <option disabled>Choisissez un auteur...</option>
                                @foreach($authors as $author)
                                    <option value="{{$author->id}}">{{$author->full_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description"
                               class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                        <div class="col-md-12">
                            {!! Form::control('textarea', $errors, 'description', 'Entrez une description...', ['style' => 'resize: none;']) !!}
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Ajouter') }}
                            </button>
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>

        {{-- Category--}}
        <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="x_panel tile overflow_hidden">
                <div class="x_title">
                    <h2>Gestion des auteurs</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    @foreach($categories as $category)
                        <div class="ui horizontal selection list">
                            <div class="item">
                                <div class="content">
                                    <a class="header">{{$category->name}}</a>
                                    {{$category->books->count()}} livres
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel tile overflow_hidden">
                <div class="x_title">
                    <h2>ajoutre une catégorie</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    {{Form::open(['url'=>route('category.store'), 'method'=>'POST', 'enctype' => "multipart/form-data"])}}

                    <div class="form-group row">
                        <label for="category_name" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>
                        <div class="col-md-6">
                            {!! Form::control('text', $errors, 'category_name', 'Nom du catégorie...') !!}
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Ajouter') }}
                            </button>
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>

        @include('dashboard.modals.book_update')
    </div>
@stop
