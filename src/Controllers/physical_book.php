<?php
namespace Library\Controllers;

use Library\Models\Physical_Book;
use Library\Models\User;
require_once __DIR__ . '/entity.php'; //entitymanager used in entity

function create_physical_book($book){
    $physical_book = new Physical_Book();
    if($book != null) {
        $physical_book->setBook($book);
    }
    //no need to set the id because it's done by setBook
    return $physical_book;
}

/**
 * @param $physical_books : an array of physical_books
 * @return int
 */
function get_number_free_phys_books($physical_books){
    $count = 0;
    foreach($physical_books as $physB){
        if($physB->getHolder() == null) {
            $count++;
        }
    }
    return $count;
}

/**
 * @param $physical_books
 * @param $user
 * @return bool
 */
function is_user_holder($physical_books, $user){
    $ans = false;
    foreach($physical_books as $physB){
        if($physB->getHolder() && $physB->getHolder()->getId() == $user->getId()) {
            $ans = true;
        }
    }
    return $ans;
}



if(isset($_GET['returnB']) && $_GET['returnB'] == true && isset($_GET['nextP'])) {
    if (isset($_POST['token'])) {
        session_start();
        if ($_POST['token'] == $_SESSION['token']) {

            return_physical_book($_SESSION['user'],$_POST['return_book']);
        }
    }
    header("Location: " . "../Views/".$_GET['nextP'].".php");
    exit();
}

/**
 * @param $user
 * @param $bookId
 * @throws \Doctrine\ORM\ORMException
 * @throws \Doctrine\ORM\OptimisticLockException
 */
function return_physical_book(User $user,$bookId){
    global $entityManager;
    $pbookRepo = $entityManager->getRepository(Physical_Book::class);
    $user = $entityManager->merge($user);
    $pbook = $pbookRepo->findOneBy(["book" => $bookId, "holder" => $user]);
    $user->removePhysicalBook($pbook);
    $entityManager->flush();
}


if(isset($_GET['borrowB']) && $_GET['borrowB'] == true && isset($_GET['nextP'])) {
    if (isset($_POST['token'])) {
        session_start();
        if ($_POST['token'] == $_SESSION['token']) {
            borrow_physical_book($_SESSION['user'],$_POST['borrow_book']);
        }
    }
    header("Location: " . "../Views/".$_GET['nextP'].".php");
    exit();
}

/**
 * @param User $user
 * @param $bookId
 * @throws \Doctrine\ORM\ORMException
 * @throws \Doctrine\ORM\OptimisticLockException
 */
function borrow_physical_book(User $user,$bookId){
    global $entityManager;
    $pbookRepo = $entityManager->getRepository(Physical_Book::class);
    $user = $entityManager->merge($user);
    $pbook = $pbookRepo->findOneBy(["book" => $bookId, "holder" => null]);
    $user->addPhysicalBook($pbook);
    $entityManager->flush();
}

function get_borrow_date($user,$bookId){
    global $entityManager;
    $pbookRepo = $entityManager->getRepository(Physical_Book::class);
    $user = $entityManager->merge($user);
    $pbook = $pbookRepo->findOneBy(["book" => $bookId, "holder" => $user]);
    return $pbook->getBorrowDate();
}

/**
 * @param $bookId
 * @throws \Doctrine\ORM\ORMException
 * @throws \Doctrine\ORM\OptimisticLockException
 */
function remove_physical_book($bookId){
    global $entityManager;
    $pbookRepo = $entityManager->getRepository(Physical_Book::class);
    $pbook = $pbookRepo->findOneBy(["book" => $bookId, "holder" => null]);
    $entityManager->remove($pbook);
    $entityManager->flush();
}

function get_taken_phys_books($physical_books){
    $count = 0;
    $taken_pbooks = array();
    foreach($physical_books as $physB){
        if($physB->getHolder() != null) {
            $taken_pbooks[$count] = $physB;
            $count++;
        }
    }
    return $taken_pbooks;
}