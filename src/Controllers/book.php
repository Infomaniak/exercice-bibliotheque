<?php
namespace Library\Controllers;

use Library\Models\Book;
require_once "utils.php"; //entitymanager used in utils

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
        return $book;
    }
    else{
        dialogBox_and_redirect('Error, title already taken, book not created.');
        header("Refresh:0");
        return null;
    }
}