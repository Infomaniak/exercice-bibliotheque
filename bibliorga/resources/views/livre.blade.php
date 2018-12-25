<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hachim
 * Date: 20/12/2018
 * Time: 23:21
 */
?>

@extends('layouts.master', ['title'=> 'Book show'])

@section('content')
    <section class="bookDetails">
        <img class="bookPhoto" src="{{asset('images/livres/le_livre_des_ames-glenn_cooper.jpg')}}" alt="Cover Book"/>
        <div class="details">
            <span><b>Le livre des âmes</b> <i>ref: </i>243</span>
            <span class="infos">Fantastique</span>
            <span><i>Par: </i><a class="authorLink" href="#">Glenn Cooper</a></span>
            <span>Publié le 17 Octobre 1998</span>
            <span class="desc">Short description of the current book here.
                You can ream more description of this book using wikipedia or buy it on amazon.
            Short description of the current book here.
                You can ream more description of this book using wikipedia or buy it on amazon.</span>
            <span><i>Quantité disponible: </i>7</span>
            <br>
            <button type="button" class="btn btn-outline-primary btn-lg">Emprunter</button>
        </div>
        <div class="feedbacks">
            <span class="headFeedback">3 Avis reçus | 3.5/5</span>
            <div class="media border p-3">
                <img src="{{asset('images/default-profile.jpg')}}" alt="John Doe" class="mr-3 mt-3 rounded-circle"
                     style="width:60px;">
                <div class="media-body">
                    <h4>Père Noël
                        <small><i>Posté le 25 Décembre 2018</i></small>
                    </h4>
                    <p>J'ai dû rendre ce livre au propriétaire qui doit le recevoir ce matin
                        mais je l'ai bien aimé, j'espère que qulqu'un à pensé à me l'offrir pour Noël.
                        <span class="note"><i>Note:</i>3.5/5</span></p>
                </div>
            </div>
            <div class="media border p-3">
                <img src="{{asset('images/default-profile.jpg')}}" alt="John Doe" class="mr-3 mt-3 rounded-circle"
                     style="width:60px;">
                <div class="media-body">
                    <h4>Durand Paul
                        <small><i>Posté le 18 Octobre 2018</i></small>
                    </h4>
                    <p>Pas mal mais pour moi ça n'est pas la meilleure oeuvre de Glenn Cooper
                        <span class="note"><i>Note:</i>2/5</span></p>
                </div>
            </div>
            <div class="media border p-3">
                <img src="{{asset('images/default-profile.jpg')}}" alt="John Doe" class="mr-3 mt-3 rounded-circle"
                     style="width:60px;">
                <div class="media-body">
                    <h4>John Doe
                        <small><i>Posté le 25 Décembre 2018</i></small>
                    </h4>
                    <p>Je trouve ce livre vraiment intéressant et j'ai adoré le lire. Je le recommande
                        <span class="note"><i>Note:</i>5/5</span></p>
                </div>
            </div>
        </div>
    </section>
@stop
