<?php
namespace Library\Controllers;

use Doctrine\ORM\ORMException;
require_once __DIR__.'/Exceptions/DatabaseException.php';
use Library\Models\User;
require_once __DIR__ . '/entity.php'; //entitymanager used in entity

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
        return null; // doesn't return found user for security
    }
}

/**
 * @throws DatabaseException when the user's role couldn't be changed
 */
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
            throw new DatabaseException("Couldn't change user's role");
        }
    }
    return false;
}
