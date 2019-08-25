@extends('layout')

@section('title')
	Livres empruntés
@endsection

@section('content')

		<div id="main" class="col-md-12 col-lg-8 offset-lg-2">
			<h3>Livres empruntés</h3>
			<hr/>
			
			<form method="post" action="/borrowed/search">
				@csrf
			  	<div class="input-group col-10 offset-1">
					<input name="search" type="text" class="form-control inputText" placeholder="Recherche..." aria-label="Recherche" value="{{ $search }}">
					<div class="input-group-append">
						<button id="searchBtn" class="btn btn-outline-secondary" type="submit">Rechercher</button>
				  	</div>
			  	</div>
		  	</form>
			<br/>
			<div id="books">
				@foreach ($books as $book)
				<a href='/books/{{ $book->id }}' class="book col-sm-12 col-md-4 col-lg-3">
					<div class="image" style='background-image: url({{ $book->picture }}); background-size: cover;'></div>
					<p class="title">{{ $book->title }}</p>
					<p class="author">{{ $book->author }}</p>
				</a>
				@endforeach
			</div>
			
			<hr/>
			
			<div id="nav">
				@if ($page > 0)
					<a href='/borrowed/{{ $previous }}' class="simple navBtn leftBtn"><i class="fa fa-chevron-left"></i>PRECEDENT</a>
				@endif

				@if ($next != $page)
					<a href='/borrowed/{{ $next }}' class="simple navBtn rightBtn">SUIVANT<i class="fa fa-chevron-right"></i></a>
				@endif
			</div>
		</div>
		
	
@endsection