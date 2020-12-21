<?php
/**
 * Created by IntelliJ IDEA.
 * User: babdo
 * Date: 01/12/2018
 * Time: 12:50
 */
?>
<nav class="navbar navbar-expand-lg navbar-light bg-green">
    <a class="navbar-brand" href="{{url('/')}}">
        <img class="idLogo" src="{{asset('images/full_Bibliorga_white_text_white.png')}}" alt="Logo Bibliorga"/>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav ml-auto">
            {{--<li class="nav-item active">--}}
                {{--<a class="nav-link" href="#">--}}
                    {{--<img class="navSearch" src="{{asset('images/icons/magnifying-glass.png')}}" alt="Icône rechercher"/>--}}
                {{--</a>--}}
            {{--</li>--}}
            @auth()
                <li class="nav-item">
                    <a class="nav-link" href="{{route('home')}}">
                        {{auth()->user()->firstname}} {{ auth()->user()->lastname }}
                        @if (!auth()->user()->isUser())
                            <span
                                class="badge badge-info">{{ auth()->user()->isAdmin() ? __('admin') :__('biblio') }}</span>
                        @endif
                    </a>
                </li>
            @endauth
            <li class="nav-item">
                <a class="nav-link" href="/">Accueil</a>
            </li>
            @if (auth()->user() && !auth()->user()->isUser())
                <li class="nav-item">
                    <a class="nav-link" href="{{route('dashboard')}}">Tableau de bord</a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{route('books.all')}}">Tous les livres</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('mybooks')}}">Mes livres</a>
            </li>
            @guest()
                <li class="nav-item">
                    <a class="nav-link" href="{{route('login')}}">Se connecter</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('register')}}">S'inscrire</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link"
                       href="{{url('login')}}"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                    >Se déconnecter
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endguest
        </ul>
    </div>
</nav>
