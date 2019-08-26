

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
            <form method="POST" action="<?php echo e(route('login')); ?>">  
                <?php echo csrf_field(); ?>
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

                <button type="submit">Se connecter</button>

                <hr/>
                <h6>Vous n'avez pas encore de compte ?</h6>
            </form>

            <br/>
            <a href="<?php echo e(route('register')); ?>" class="button switch">S'inscrire</a>
        </div>

    </body>
</html>
<?php /**PATH /Users/yohann/code/library/resources/views/auth/login.blade.php ENDPATH**/ ?>