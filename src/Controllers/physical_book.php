<?php
namespace Library\Controllers;

use Doctrine\ORM\ORMException;
use Library\Models\Physical_Book;

require_once "utils.php";

$entityManager = require '../../bootstrap.php';

function create_physical_book($book){
    global $entityManager;
    $physical_book = new Physical_Book();
    $physical_book->setBook($book);
    try {
        $entityManager->persist($physical_book);
        $entityManager->flush();
        dialogBox_and_redirect("Physical_Book created !");
        header("Refresh:0");
        return $physical_book;
    } catch (ORMException $e) {
        dialogBox_and_redirect("Error accessing database. \n $e");
        header("Refresh:0");
        return null;
    }
}