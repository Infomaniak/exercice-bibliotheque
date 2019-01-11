<?php
namespace Library\Controllers;

use Doctrine\ORM\ORMException;
use Library\Models\User;
require_once "utils.php"; //entitymanager used in utils

function create_user($firstName, $lastName, $mail, $password){
    global $entityManager;
    $userRepo = $entityManager->getRepository(User::class);
    $user = $userRepo->findOneBy(["mail" => $mail]);
    if($user == null) { //if user isn't already in database
        $user = new User();
        $user->setFirstname($firstName);
        $user->setLastname($lastName);
        $user->setMail($mail);
        $user->setPassword($password);
        $user->setRole("user");
        return $user;
    }
    else{
        dialogBox_and_redirect('Error, mail already taken, account not created.', '../Views/index.php');
        return null;
    }
}

function change_role(User $user, $role)
{
    $role = strtolower($role);
    if ($role == "user" || $role == "librarian" || $role == "admin"){
        global $entityManager;
        $user->setRole($role);
        try {
            $entityManager->persist($user);
            $entityManager->flush();
            return true;
        }
        catch (ORMException $e) {
            dialogBox_and_redirect("Error changing role, $e.");
        }
    }
    return false;
}
