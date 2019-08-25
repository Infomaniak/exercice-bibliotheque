@extends('layout')

@section('title')
		Ajouter un livre
@endsection

@section('content')

		<div id="main" class="col-md-12 col-lg-8 offset-lg-2">


		   @if (count($errors) > 0)
		    <div class="alert alert-danger">
		     Upload Validation Error<br><br>
		     <ul>
		      @foreach ($errors->all() as $error)
		       <li>{{ $error }}</li>
		      @endforeach
		     </ul>
		    </div>
		   @endif
		   @if ($message = Session::get('success'))
		   <div class="alert alert-success alert-block">
		    <button type="button" class="close" data-dismiss="alert">×</button>
		           <strong>{{ $message }}</strong>
		   </div>
		   <img src="/images/{{ Session::get('path') }}" width="300" />
		   @endif

			<form method="post" action="/books" enctype="multipart/form-data">
				@csrf

				<input id="authorInput" name="author" type="text" class="form-control inputText" placeholder="Auteur" aria-label="Auteur"/>
				<input id="titleInput" name="title" type="text" class="form-control inputText" placeholder="Titre" aria-label="Titre"/>
				<hr/>


				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-12 col-md-4 col-lg-3">

							       <input class="big-image" type="file" name="picture" />
					
							<hr/>
						</div>

						<div class="col-sm-12 col-md-8 col-lg-9">
							<h5>Synopsis</h5>

							<textarea id="synopsisInput" name="synopsis" class="form-control inputText" placeholder="Synopsis" aria-label="Synopsis"></textarea>
						</div>
					</div>
				</div>
			
				<hr/>

				<button type="submit" class="simple buttonLink">Ajouter</button>	

		  	</form>
		</div>
		
	
@endsection