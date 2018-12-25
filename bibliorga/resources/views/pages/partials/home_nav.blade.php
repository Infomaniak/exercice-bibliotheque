<?php
/**
 * Created by IntelliJ IDEA.
 * User: babdo
 * Date: 23/12/2018
 * Time: 21:46
 */
?>

<section class="booksContainer">
    <nav class="sideNav">
        <a class="sideLink {{Request::is('home') ? 'active' : ''}}" href="{{route('home')}}">Mon compte</a>
        <a class="sideLink {{Request::is('books/activity') ? 'active' : ''}}" href="{{route('mybooks')}}">Mes livres</a>
        <a class="sideLink" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Deconnexion</a>
    </nav>
</section>
