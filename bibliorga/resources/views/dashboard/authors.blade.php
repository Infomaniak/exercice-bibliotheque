<?php
/**
 * Created by IntelliJ IDEA.
 * User: babdo
 * Date: 22/12/2018
 * Time: 16:27
 */
?>

@extends('layouts.dashboard', ['title' => 'Gestion des auteurs'])

@section('content')
    <div class="row" ng-controller="authorController">
        <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="x_panel tile overflow_hidden" style="height: 500px">
                <div class="x_title">
                    <h2>Gestion auteurs</h2>
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
                    <table class="table table-hover">
                        <tr>
                            <th>id</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>action</th>
                        </tr>
                        @foreach($authors as $author)
                            <tr>
                                <td>{{$author->id}}</td>
                                <td>{{$author->lastname}}</td>
                                <td>{{$author->firstname}}</td>
                                <td>
                                    <a href="{{route('author.show', ['id'=>$author->id])}}"
                                       class="btn-sm btn-primary"><span
                                            class="glyphicon glyphicon-eye-open"></span></a>
                                    <a href="#" class="btn-sm btn-warning"
                                       ng-click="showMyModal({{$author}})"
                                       data-toggle="modal" data-target="#author_show_modal">
                                        <span
                                            class="glyphicon glyphicon-pencil"></span></a>
                                    <a href="#" class="btn-sm btn-danger"><span
                                            class="glyphicon glyphicon-trash"></span></a>
                                </td>
                            </tr>
                        @endforeach
                        {{$authors->links()}}
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel tile overflow_hidden" style="height: 500px">
                <div class="x_title">
                    <h2>ajoutre un auteur</h2>
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
                    {{Form::open(['url'=>route('author.store'), 'method'=>'POST', 'enctype' => "multipart/form-data"])}}
                    <div class="form-group row">
                        <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Photo') }}</label>
                        <div class="col-md-6">
                            {!! Form::control('file', $errors, 'photo', 'Votre image...') !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>
                        <div class="col-md-6">
                            {!! Form::control('text', $errors, 'lastname', 'Votre nom...') !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('Prénom') }}</label>
                        <div class="col-md-6">
                            {!! Form::control('text', $errors, 'firstname', 'Votre prénom...') !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="biography"
                               class="col-md-4 col-form-label text-md-right">{{ __('Bibliographie') }}</label>
                        <div class="col-md-12">
                            {!! Form::control('textarea', $errors, 'biography', 'Bibliographie', ['style' => 'resize: none;']) !!}
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

        @include('dashboard.modals.author_update')
    </div>
@stop
