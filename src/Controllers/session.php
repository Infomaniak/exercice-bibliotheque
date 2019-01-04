<?php
namespace Library\Controllers;
session_start();

use Library\Models\User;
require_once "utils.php";
require_once "user.php";

$entityManager = require '../../bootstrap.php';
if(isset($_POST['submit'])){
    if($_POST['submit'] == "register"){
        $user = create_account();
        init_session($user);
    }
    elseif ($_POST['submit'] == "sign_in"){
        init_session();
    }
    elseif ($_POST['submit'] == "log_out") {
        destroy_session();
    }
}

function create_account(){
    if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['mail']) && isset($_POST['password'])) {
        return create_user($_POST['firstName'], $_POST['lastName'],$_POST['mail'],$_POST['password']);
    }
    else {
        dialogBox_and_redirect('Error, account not created.', '../Views/index.php');
    }
    return null;
}

function init_session(User $user = null){
    $message = null;
    if($user != null){
        $_SESSION['firstName'] = $user->getFirstname();
        $_SESSION['lastName'] = $user->getLastname();
        $_SESSION['mail'] = $user->getMail();
        $_SESSION['role'] = $user->getRole();
        $message = "Connection done !";
    }
    elseif(isset($_POST['mail']) && isset($_POST['password'])) {
        global $entityManager;
        $userRepo = $entityManager->getRepository(User::class);
        $user = $userRepo->findOneBy(["mail" => $_POST['mail']]);
        $password = hash("sha256", $_POST['password']);
        if($user->getPassword() == $password) {
            $_SESSION['firstName'] = $user->getFirstname();
            $_SESSION['lastName'] = $user->getLastname();
            $_SESSION['mail'] = $_POST['mail'];
            $message = "Connection done !";
        }
        else{
            $message = "Incorrect password...";
        }
    }
    else {
        $message = "Member unknown...";
    }
    dialogBox_and_redirect($message, '../Views/index.php');
}

function destroy_session(){
    session_unset();
    session_destroy();
    dialogBox_and_redirect("Logged out !", '../Views/index.php');
}