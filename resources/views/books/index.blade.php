@extends('layouts.app')

@section('content')
<div class="container">
    <br />
    @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
     @endif
    <table class="table table-striped">
	    <thead>
	      <tr>
	        <th>ID</th>
	        <th>Name</th>
	        <th>Author</th>
	        <th>Description</th>
	        <th colspan="3">Action</th>
	      </tr>
	    </thead>
	    <tbody>
	      
	      @foreach($books as $book)
	      <tr>
	        <td>{{$book['id']}}</td>
	        <td>{{$book['name']}}</td>
	        <td>{{$book['author']}}</td>
	        <td>{{$book['description']}}</td>
	        
	        @if ($book['user_id'] == null)
	        	<td><a href="{{url('/books/'.$book['id'].'/borrow')}}" class="btn btn-info">Borrow</a></td>
	        @else
	        	<td>Not available
	        	@if (Auth::check() && Auth::user()->isAdmin == '1')
	        		<br>Borrowed by <strong>{{\App\User::find($book['user_id'])->name}}</strong>
	        	@endif
	        	</td>
	        @endif

	        @if (Auth::check() && Auth::user()->isAdmin == '1')
		        <td><a href="{{action('BookController@edit', $book['id'])}}" class="btn btn-warning">Edit</a></td>
		        <td>
		          <form action="{{action('BookController@destroy', $book['id'])}}" method="post">
		            @csrf
		            <input name="_method" type="hidden" value="DELETE">
		            <button class="btn btn-danger" type="submit">Delete</button>
		          </form>
		        </td>
		    @endif
	      </tr>
	      @endforeach

	    </tbody>
    </table>

  	@if (Auth::check() && Auth::user()->isAdmin == '1')
  		<a href="{{action('BookController@create')}}">Add</a>
  	@endif
  </div>
@endsection