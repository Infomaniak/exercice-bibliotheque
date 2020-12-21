<?php
/**
 * Created by IntelliJ IDEA.
 * User: babdo
 * Date: 22/12/2018
 * Time: 16:27
 */
?>

@extends('layouts.dashboard', ['title' => 'Gestion utilisateurs'])

@section('content')
    <div class="row" ng-controller="userController">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="dashboard_graph">

                <div class="row x_title">
                    <div class="col-md-6">
                        <h3>Gestion des utilisateurs
                            <small>Graph title sub-title</small>
                        </h3>
                    </div>
                    {{--<div class="col-md-6">--}}
                    {{--<div id="reportrange" class="pull-right"--}}
                    {{--style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">--}}
                    {{--<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>--}}
                    {{--<span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                </div>

                <div class="col-md-9 col-sm-9 col-xs-12" style="overflow: auto">
                    <!-- Table -->
                    <table class="table table-hover">
                        <tr>
                            <th>id</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Date</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>action</th>
                        </tr>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->lastname}}</td>
                                <td>{{$user->firstname}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->created_at}}</td>
                                <td>{{$user->role}}</td>
                                <td>
                                    {!! $user->hasVerifiedEmail()
                                    ? __('<span class="label label-success">vérifié</span>')
                                    : __('<span class="label label-danger">non vérifié</span>') !!}
                                </td>
                                <td>
                                    <a href="#" class="btn-sm btn-primary">
                                        <span
                                            class="glyphicon glyphicon-eye-open">
                                        </span>
                                    </a>
                                    <a href="#" class="btn-sm btn-warning" ng-click="showMyModal({{$user}})"
                                       data-toggle="modal" data-target="#user_show_modal">
                                        <span
                                            class="glyphicon glyphicon-pencil">
                                        </span>
                                    </a>
                                    <a href="#" class="btn-sm btn-danger"><span
                                            class="glyphicon glyphicon-trash"></span></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                    {{$users->links()}}
                </div>

                <div class="clearfix"></div>
            </div>
        </div>

        @include('dashboard.modals.user_update')
    </div>
    <br/>
@stop
