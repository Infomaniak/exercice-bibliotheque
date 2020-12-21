@extends('layouts.master', ['title'=> 'Bienvenue'])

@section('content')
    <div class="heading bg-green">
        <p class="citation">
            “Qui veut se connaître,<br>qu'il ouvre un livre.” <i>Jean Paulhan</i>
        </p>
    </div>
    <section class="firstSection">
        <div class="nano">
            <p class="nano-content" style="max-height: 203px; box-sizing: content-box; overflow: auto;">
                Vous n'avez pas besoin d'acheter des livres pour les lires. Bibliorga vous propose d'emprunter de
                milliers
                d'histoires,
                des livres scolaires et de nombreuses autres lectures. Rien ne remplace les pages d'un livre.
                Inscrivez-vous
                et empruntez.
                <br>
                Il est parfois difficile de faire un choix quand on l'a, c'est pourquoi on vous propose les
                meilleurs
                livres
                selon
                les utilisateurs qui lisent la même chose que vous. Ne passez plus des heures à chercher.
                <br>
                Découvrez nos bibliothèques à travers toute la France.
                <br><br>
            </p>
        </div>
        <a class="btn linkButton mt-2" href="#">Où nous trouver ? → </a>
    </section>
    <section class="booksContainer">
        <h3 class="boldH3">Les plus lus</h3>
        <div class="per4container">
            @forelse($most_viewed as $borrow)
                <div class="per4">
                    <a href="{{route('book.show', ['id'=>$borrow->get(0)->book->id])}}" class="book">
                        <img src="{{$borrow->get(0)->book->cover_url}}" alt="Livre"/>
                        <span class="bookinfos">
                        <span class="bookTitle">{{$borrow->get(0)->book->title}} - <i class="auteur">{{$borrow->get(0)->book->author->full_name}}</i></span>
                    </span>
                    </a>
                </div>
            @empty
                <p>{{ __('Désolé aucun nouveau livre n\'a été trouver.') }}</p>
            @endforelse
        </div>
        <a class="btn linkButton" href="{{route('books.viewed')}}">Voir plus → </a>
    </section>
    <section class="booksContainer">
        <h3 class="boldH3">Nouveautés</h3>
        <div class="per4container">
            @forelse($new_books as $book)
            <div class="per4">
                <a href="{{route('book.show', ['id'=>$book->id])}}" class="book">
                    <img src="{{$book->cover_url}}" alt="Livre"/>
                    <span class="bookinfos">
                        <span class="bookTitle">{{$book->title}} - <i class="auteur">{{$book->author->full_name}}</i></span>
                    </span>
                </a>
            </div>
                @empty
                <p>{{ __('Désolé aucun nouveau livre n\'a été trouver.') }}</p>
                @endforelse
        </div>
        <a class="btn linkButton" href="{{route('books.new')}}">Voir plus → </a>
    </section>
@stop
