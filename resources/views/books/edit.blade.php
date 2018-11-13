@extends('layouts.app')

@section('content')
<div class="container">
        <h2>Edit a book</h2><br  />
        <form method="post" action="{{action('BookController@update', $id)}}">
	        @csrf
	        <input name="_method" type="hidden" value="PATCH">

	        <div class="row">
	          <div class="col-md-4"></div>
	          <div class="form-group col-md-4">
	            <label for="name">Name:</label>
	            <input type="text" class="form-control" name="name" value="{{$book->name}}" required>
	          </div>
	        </div>

        	<div class="row">
	          <div class="col-md-4"></div>
	          <div class="form-group col-md-4">
	            <label for="author">Author:</label>
	            <input type="text" class="form-control" name="author" value="{{$book->author}}" required>
	          </div>
	        </div>

	        <div class="row">
	          <div class="col-md-4"></div>
	          <div class="form-group col-md-4">
	            <label for="description">Description:</label>
	            <textarea class="form-control" id="description" name="description" required>{{$book->description}}</textarea>
	          </div>
	        </div>

	        <div class="row">
	          <div class="col-md-4"></div>
	          <div class="form-group col-md-4" style="margin-top:60px">
	            <button type="submit" class="btn btn-success" style="margin-left:38px">Update</button>
	          </div>
	        </div>
        </form>
</div>
@endsection