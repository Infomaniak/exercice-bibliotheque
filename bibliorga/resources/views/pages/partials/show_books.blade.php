<?php
/**
 * Created by IntelliJ IDEA.
 * User: babdo
 * Date: 23/12/2018
 * Time: 17:49
 */
?>

<div class="per4container">
    @forelse($books as $book)
        <div class="per4">
            <a href="{{route('book.show', ['id'=>$book->id])}}" class="book">
                <img src="{{$book->cover_url}}" alt="Livre"/>
                <span class="bookinfos">
                        <span class="bookTitle">{{$book->title}} - <i
                                class="auteur">{{$book->author->full_name}}</i></span>
                    </span>
            </a>
        </div>
    @empty
        <p>{{ __('Désolé aucun nouveau livre n\'a été trouver.') }}</p>
    @endforelse
</div>
{{$links}}
