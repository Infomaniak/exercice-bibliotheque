<?php
/**
 * Created by IntelliJ IDEA.
 * User: babdo
 * Date: 01/12/2018
 * Time: 12:43
 */
?>
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{asset('images/favicon.png')}}"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} | {{$title}}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/nanoscroller.css')}}">
    <style>
        .nano { height: 203px; }

        .nano .nano-content { padding: 10px; }

        .nano .nano-pane { background: #d4e8e1; }

        .nano .nano-slider { background: #24c88c; }
    </style>
    @yield('styles')
</head>
<body>
@if(session()->has('success'))
    <div class="alert alert-success alert-dismissible position-absolute fade show" role="alert"
         style="z-index: 1; top: 10vh; right: 1px">
        <strong>Succès!</strong> {{session('success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif(!empty($errors->first()))
    @for($i=0; $i<$errors->count(); $i++)
        <div class="alert alert-danger alert-dismissible position-absolute fade show" role="alert"
             style="z-index: 1; top: {{10*0.5*$i+1}}vh; right: 1px">
            <strong>Erreur!</strong> {{$errors->first()}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endfor
@endif
{{-- ----- --}}
@if (auth()->user() && !auth()->user()->hasVerifiedEmail())
    <div class="alert alert-danger alert-dismissible fade show m-0" role="alert">
        <strong>Attention!</strong> Veuillez confirmer votre compte.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@include('layouts.partials.header')
@yield('content')
@include('layouts.partials.footer')
<!-- Scripts -->
<script src="{{ mix('js/app.js') }}" defer></script>
<script src="{{ asset('js/jquery.nanoscroller.min.js') }}" defer></script>
<script>
    window.onload = function () {
        $(".alert").delay(4000).slideUp(200, function () {
            $(this).alert('close');
        });

        $(".nano").nanoScroller();
    }
</script>
@yield('scripts')
</body>
</html>
