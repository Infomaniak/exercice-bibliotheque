<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Library</title>
		<link rel="stylesheet" type="text/css" href="<?php echo e(url('/css/style.css')); ?>" />
		<link rel="stylesheet" href="https://use.typekit.net/jxh3drs.css">
	</head>

	<body>
		<div id="bg">
		</div>
		
		<input id="connectRad" hidden type="radio" name="menu" checked/>
		<div id="connectionPanel" class="panel">
            <form method="POST" action="<?php echo e(route('login')); ?>">	
				<p>E-mail</p>
				<input id="email" type="email" class="form-control <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>
				<p>Mot de passe</p>
				<input id="password" type="password" class="form-control <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="password" required autocomplete="current-password">
				<button>Se connecter</button>
			</form>
			<h6>Vous n'avez pas encore de compte ?</h6>
			<button id="signup" onclick="document.getElementById('signupRad').checked=true;">S'inscrire</button>
		</div>
		
		<input id="signupRad" hidden type="radio" name="menu"/>
		<div id="signupPanel" class="panel">
			<form method="post" action=".">
				<p>Identifiant</p>
				<input type="text"/>
				<p>Choisissez un mot de passe</p>
				<input type="password"/>
				<p>Entrez votre mot de passe à nouveau</p>
				<input type="password"/>
				<button>S'inscrire</button>
			</form>
			<button id="signup" onclick="document.getElementById('connectRad').checked=true;">Retour</button>
		</div>
	</body>
</html>
<?php /**PATH /Users/yohann/code/library/resources/views/index.blade.php ENDPATH**/ ?>