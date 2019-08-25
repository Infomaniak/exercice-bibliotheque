@extends('layout')

@section('title')
		{{ $book->title }}
@endsection

@section('content')

		<div id="main" class="col-md-12 col-lg-8 offset-lg-2">
			<h6>{{ $book->author }}</h6>
			<h3>{{ $book->title }}</h3>
			<hr/>

			<div class="container-fluid">
				<div class="row">

					<div class="col-sm-12 col-md-4" style="border-right: 1px solid #DDD;">
						<div class="big-image" style='background-image: url({{ $book->picture }});'></div>
						<hr/>

						@if (Auth::check())
							@if ($book->borrower == NULL && Auth::user()->librarian)
								<p style="font-style: italic; text-align: center;">Actuellement disponible</p>
							@elseif ($book->borrower == NULL)
								<form method="POST" action="/books/{{ $book->id }}">
									@csrf

									<button type="submit" class="simple buttonLink">Reserver</button>
								</form>
							@elseif (Auth::user()->name == $book->borrower)
								<form method="POST" action="/books/{{ $book->id }}">
									@csrf

									<button type="submit" class="simple buttonLink">Rendre</button>
								</form>
							@else
								<p style="font-style: italic; text-align: center;">Actuellement emprunté par {{ $book->borrower }}</p>
							@endif

							@if (Auth::user()->librarian)
								<a href='/books/{{ $book->id }}/edit' class="simple buttonLink">Éditer</a>
							@endif
						@else
							<p style="font-style: italic; text-align: center;">Vous devez être connecté pour emprunter un livre.</p>
						@endif
					</div>


					<div class="col-sm-12 col-md-8">
						<h5>Synopsis</h5>
						<p>{{ $book->synopsis }}</p>
					</div>
				</div>
			</div>
			
			<hr/>
			
			<div id="nav">
				@if ($previous != $book->id)
					<a href='/books/{{ $previous }}' class="simple navBtn leftBtn"><i class="fa fa-chevron-left"></i>LIVRE PRECEDENT</a>
				@endif

				@if ($next != $book->id)
					<a href='/books/{{ $next }}' class="simple navBtn rightBtn">LIVRE SUIVANT<i class="fa fa-chevron-right"></i></a>
				@endif
			</div>
		</div>
		
	
@endsection