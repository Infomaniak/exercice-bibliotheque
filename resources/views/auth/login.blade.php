

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
            <form method="POST" action="{{ route('login') }}">  
                @csrf
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

                <button type="submit">Se connecter</button>

                <hr/>
                <h6>Vous n'avez pas encore de compte ?</h6>
            </form>

            <br/>
            <a href="{{ route('register') }}" class="button switch">S'inscrire</a>
        </div>

    </body>
</html>
