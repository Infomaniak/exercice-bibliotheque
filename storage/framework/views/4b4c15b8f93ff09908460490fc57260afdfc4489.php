


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
        
        <div id="connectionPanel" class="panel">
            <form method="POST" action="<?php echo e(route('register')); ?>">  
                <?php echo csrf_field(); ?>

                <p>Nom d'utilisateur</p>
                <input id="name" type="text" class="form-control <?php if ($errors->has('name')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('name'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="name" value="<?php echo e(old('name')); ?>" required autocomplete="name" autofocus>

                <?php if ($errors->has('name')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('name'); ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>

                <p>E-mail</p>
                <input id="email" type="email" class="form-control <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>

                <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>

                <p>Mot de passe</p>
                <input id="password" type="password" class="form-control <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="password" required autocomplete="current-password">

                <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>

                <p>Confirmer votre mot de passe</p>
                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>

                <button type="submit">S'inscrire</button>

                <hr/>
                <h6>Vous avez déjà un compte ?</h6>
                <br/>
                <a href="<?php echo e(route('login')); ?>" class="button switch">Se connecter</a>
            </form>
        </div>

    </body>
</html>

<?php /**PATH /Users/yohann/code/library/resources/views/auth/register.blade.php ENDPATH**/ ?>