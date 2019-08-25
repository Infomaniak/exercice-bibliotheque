


<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Library</title>
        <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />
        <link rel="stylesheet" href="https://use.typekit.net/jxh3drs.css">
    </head>

    <body>
        <div id="bg">
        </div>
        
        <div id="connectionPanel" class="panel">
            <form method="POST" action="{{ route('register') }}">  
                @csrf

                <p>Nom d'utilisateur</p>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <p>E-mail</p>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <p>Mot de passe</p>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <p>Confirmer votre mot de passe</p>
                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>

                <button type="submit">S'inscrire</button>

                <hr/>
                <h6>Vous avez déjà un compte ?</h6>
                <br/>
                <a href="{{ route('login') }}" class="button switch">Se connecter</a>
            </form>
        </div>

    </body>
</html>

