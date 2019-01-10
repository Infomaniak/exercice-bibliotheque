<?php
namespace Library\Controllers;

use Doctrine\ORM\ORMException;
use Library\Models\Book;
require_once "utils.php";

$entityManager = require '../../bootstrap.php';

function create_book($category, $publisher, $title, $release_date, $pdf){
    global $entityManager;
    $publisherRepo = $entityManager->getRepository(Book::class);
    $book = $publisherRepo->findOneBy(["title" => $title]);
    if($book == null) { //if book isn't already in database
        $book = new Book();
        $book->setCategory($category);
        $book->setPublisher($publisher);
        $book->setTitle($title);
        $book->setReleaseDate($release_date);
        $book->setPdf($pdf);
        try {
            $entityManager->persist($book);
            $entityManager->flush();
            dialogBox_and_redirect("Book created !");
            header("Refresh:0");
            return $book;
        } catch (ORMException $e) {
            dialogBox_and_redirect("Error accessing database. \n $e");
            header("Refresh:0");
            return null;
        }
    }
    else{
        dialogBox_and_redirect('Error, title already taken, book not created.');
        header("Refresh:0");
        return null;
    }
}