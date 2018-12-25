@extends('layouts.master', ['title'=>'Inscription'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        {{Form::open(['url'=>route('register'), 'method'=>'POST'])}}
                        <div class="form-group row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>
                            <div class="col-md-6">
                                {!! Form::control('text', $errors, 'lastname', 'Votre nom...') !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="firstname"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Prénom') }}</label>
                            <div class="col-md-6">
                                {!! Form::control('text', $errors, 'firstname', 'Votre prénom...') !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sex"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Sexe') }}</label>
                            <div class="col-md-6">
                                <select id="sex" name="sex" class="form-control">
                                    <option disabled>Choisissez votre sex...</option>
                                    <option value="male">Homme</option>
                                    <option value="female">Femme</option>
                                </select>
                                @if($errors->has('sex'))
                                    <span class='invalid-feedback' role='alert'>
                                    <strong>{{$errors->first('sex')}}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                            <div class="col-md-6">
                                {!! Form::control('email', $errors, 'email', 'Votre email...') !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="birthday"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Date de naissance') }}</label>
                            <div class="col-md-6">
                                {!! Form::control('date', $errors, 'birthday', 'Votre date de naissance...') !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password_id"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>
                            <div class="col-md-6">
                                <input id="password_id" type="password"
                                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       name="password" placeholder="Votre mot de passe..." required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Confirmer Mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" placeholder="Confirmer le mot de passe" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('S\'inscrire') }}
                                </button>
                            </div>
                        </div>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
