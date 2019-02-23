<?php
namespace Library\Controllers;
session_start();

use Library\Models\User;
require_once __DIR__ . '/entity.php'; //entitymanager used in entity
require_once __DIR__.'/user.php';

function check_submitted_data(){
    return isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['mail']) && isset($_POST['password']);
}

function create_account(){
    $user = create_user($_POST['firstName'], $_POST['lastName'],$_POST['mail'],$_POST['password']);
    try {
        store_entity($user);
    } catch (DatabaseException $e) {
        return null;
    }
    return $user;
}

function init_session(User $user = null){
    if($user != null){ // if we come from the register_form
        $_SESSION['user'] = $user;
    }
    elseif(isset($_POST['mail']) && isset($_POST['password'])) { // if we come from the sign_in_form
        global $entityManager;
        $userRepo = $entityManager->getRepository(User::class);
        $user = $userRepo->findOneBy(["mail" => $_POST['mail']]);
        $password = hash("sha256", $_POST['password']);
        if ($user->getPassword() == $password) {
            $_SESSION['user'] = $user;
            return true;
        }
        else{
            return false;
        }
    }
}

function destroy_session(){
    session_unset();
    session_destroy();
}