<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Library | @yield('title')</title>
		<link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />
			<link rel="stylesheet" href="https://use.typekit.net/jxh3drs.css">
			<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	</head>

	<body>
		<div id="bg"></div>
		
		<header id="header" class="col-md-12 col-lg-8 offset-lg-2">
			<a href="/"><h1 id="logo"><i class="fa fa-book"></i>Library</h1><a>

			@if (Auth::check())
				<button id="menu" onClick="document.getElementById('topmenu').classList.toggle('opened');"><span id="pseudo">{{ Auth::user()->name }}</span><i class="fa fa-bars"></i></button>
			@else
				<form method="GET" action="{{ route('login') }}">
					<button id="menu" type="submit">Connexion</button>
				</form>
			@endif
		
			@if (Auth::check())
				<div id="topmenu" class="col-sm-12 offset-md-8 col-md-4 offset-lg-9 col-lg-3">

					@if (Auth::user()->librarian)
						<form method="GET" action="/borrowed">
							<button type="submit" class="menuBtn">Livres empruntés</button>
						</form>
						<form method="GET" action="/books/create">
							<button type="submit" class="menuBtn">Ajouter un livre</button>
						</form>
					@else
						<form method="GET" action="/my-books">
							<button type="submit" class="menuBtn">Mes livres</button>
						</form>
					@endif

					<form method="POST" action="{{ route('logout') }}">
						@csrf
						<button type="submit" class="menuBtn" style="background-color: #E35; color: white;">Deconnexion</button>
					</form>
				</div>
			@endif
			
		</header>
		

		@yield('content')
		
	
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>
</html>