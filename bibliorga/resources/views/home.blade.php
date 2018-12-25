@extends('layouts.master', ['title'=> 'Bienvenue'])

@section('content')

    @include('pages.partials.home_nav')

    <section class="myAccountContainer">
        {!! Form::model(Auth::user(), ['url'=>route('user.update', ['id' => auth()->user()->id]), 'method'=>'PUT', 'enctype' => "multipart/form-data"]) !!}
        <img class="userProfilePhoto" src="{{auth()->user()->profile_image}}" alt="Photo de profile">
        <div>Photo</div>
        <div class="custom-file">
            <input name="profile_image" type="file" class="form-control" id="customFile" accept="image/*">
        </div>
        <br>
        <br>
        <div class="form-row">
            <div class="col">
                <div>Nom</div>
                {!! Form::text('lastname' , null, ['class'=>'form-control', 'placeholder'=>"Nom"]) !!}
            </div>
            <div class="col">
                <div>Prénom</div>
                {!! Form::text('firstname' , null, ['class'=>'form-control', 'placeholder'=>"Prénom"]) !!}
            </div>
        </div>
        <br>
        <div class="form-row mt-10">
            <div class="form-group col-md-4">
                <div>Email</div>
                <div>
                    {!! Form::text('email' , null, ['class'=>'form-control', 'placeholder'=>"Prénom", 'id'=>"staticEmail", 'readonly'=>'readonly']) !!}
                </div>
            </div>
            <div class="form-group col-md-4">
                <div>Date de naissance</div>
                <div class="">
                    {!! Form::date('birthday' , null, ['class'=>'form-control', 'placeholder'=>"Votre date de naissance..", 'id'=>"birthday"]) !!}
                </div>
            </div>
            <div class="form-group col-md-4">
                <div>Sexe</div>
                {!! Form::select('sex', ['male' => 'Homme', 'female' => 'Femme'], null, ['id'=>"exampleFormControlSelect1", 'class'=>'form-control']) !!}
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        {!! Form::close() !!}
    </section>
@stop
