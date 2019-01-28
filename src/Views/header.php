<?php
include_once __DIR__ . '/../../vendor/autoload.php';

require_once __DIR__.'/../Controllers/session.php';
use function Library\Controllers\{check_submitted_data,create_account,init_session,destroy_session};

if(isset($_POST['submit'])){
    if($_POST['submit'] == "register" && check_submitted_data()){
        $user = create_account();
        if($user != null) {
            init_session($user);
        }
        else{
            echo "Couldn't create your account, maybe your mail is already taken ? Please try again.";
        }
    }
    elseif ($_POST['submit'] == "sign_in"){
        init_session();
    }
    elseif ($_POST['submit'] == "log_out") {
        destroy_session();
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <title>YouLib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
</head>
<body>