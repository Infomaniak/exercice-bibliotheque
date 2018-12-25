<?php
/**
 * Created by IntelliJ IDEA.
 * User: babdo
 * Date: 24/12/2018
 * Time: 01:01
 */
?>

@extends('layouts.dashboard', ['title' => 'Gestion des emprunts'])

@section('content')
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel tile overflow_hidden">
                <div class="x_title">
                    <h2>Emprunts en cours</h2>
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
                            <th>Utilisateur</th>
                            <th>Livre</th>
                            <th>Emprunter</th>
                            <th>à Rendre</th>
                        </tr>
                        @foreach($borrow_not_delivred as $borrow)
                            <tr>
                                <td>{{$borrow->id}}</td>
                                <td>{{$borrow->user->full_name}}</td>
                                <td>{{$borrow->book->title}}</td>
                                <td>{{$borrow->created_at->format('d/m/Y')}}</td>
                                <td>{{$borrow->delivred_date->format('d/m/Y')}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel tile overflow_hidden">
                <div class="x_title">
                    <h2>Livres déjà rendu</h2>
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
                            <th>Utilisateur</th>
                            <th>Livre</th>
                            <th>Emprunter</th>
                            <th>Rendu le</th>
                        </tr>
                        @foreach($borrow_delivred as $borrow)
                            <tr>
                                <td>{{$borrow->id}}</td>
                                <td>{{$borrow->user->full_name}}</td>
                                <td>{{$borrow->book->title}}</td>
                                <td>{{$borrow->created_at->format('d/m/Y')}}</td>
                                <td>{{$borrow->updated_at->format('d/m/Y')}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
