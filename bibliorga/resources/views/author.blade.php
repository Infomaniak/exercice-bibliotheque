<?php
/**
 * Created by IntelliJ IDEA.
 * User: BOINAIDI Abdourahamane
 * Date: 20/12/2018
 * Time: 23:27
 */
?>

@extends('layouts.master', ['title'=> 'Author'])

@section('content')
    <section class="author">
        <img class="authorPhoto" src="{{asset('images/authors/glenn-cooper.jpg')}}" alt="Photo Glenn Cooper">
        <h4 class="authorName">Glenn Cooper</h4>
        <span class="biography">
        Né le 8 janvier 1953 à White Plains, dans l'État de New York, est un médecin,
            romancier, scénariste et producteur de cinéma américain, auteur de roman policier.
        </span>
    </section>
    <section class="booksContainer">
        <h3 class="boldH3">Œuvres</h3>
        <div class="per4container">
            <div class="per4">
                <a href="#" class="book">
                    <img src="{{asset('images/livres/le_livre_des_ames-glenn_cooper.jpg')}}" alt="Livre"/>
                    <span class="bookinfos">
                        <span class="bookTitle">Le livre des âmes - <i class="auteur">Glenn Cooper</i></span>
                    </span>
                </a>
            </div>
            <div class="per4">
                <a href="#" class="book">
                    <img src="{{asset('images/livres/la_musique_du_silence-patrick_rothfuss.jpg')}}" alt="Livre"/>
                    <span class="bookinfos">
                        <span class="bookTitle">La musique du silence - <i class="auteur">Patrick Rothfuss</i></span>
                    </span>
                </a>
            </div>
        </div>
    </section>
@stop


