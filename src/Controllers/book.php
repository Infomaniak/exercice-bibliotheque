<?php
namespace Library\Controllers;

use Library\Models\Book;
require_once __DIR__ . '/entity.php'; //entitymanager used in entity

function create_book($category, $publisher, $title, $release_date, $pdf, $synopsis, $authors = null){
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
        $book->setSynopsis($synopsis);
        $book->addAuthors($authors);
    }
    return $book;
}