<?php

$entityManager = require_once join(DIRECTORY_SEPARATOR, ['bootstrap.php']);

use Library\Models\Author;
use Library\Models\Book;
use Doctrine\Common\Collections\ArrayCollection;

$books = new ArrayCollection();
$authors = new ArrayCollection();

foreach (range(1, 10) as $index) {
    $book = new Book();
    $book->setTitle("Book".$index);
    $book->setCategory(1);
    try { $book->setReleaseDate(new \Datetime("2017-03-03T09:00:00Z")); }
    catch (Exception $e) {}
    $book->setPublisher(1);
    $book->setPdf("http://www.books.fr/".$index);
    $entityManager->persist($book);
    $books->add($book);
}

foreach (range(1, 10) as $index) {
    $author = new Author();
    $author->setName("Author".$index);
    $entityManager->persist($author);
    $authors->add($author);
}



foreach (range(0, 9) as $index){
    $book = new Book();
    $author = new Author();
    $book = $books->get($index);
    echo $book;
    foreach (range(0, 9) as $index2) {
        $author = $authors->get($index2);
        echo $author;
        $book->addAuthor($author);
    }
}

$entityManager->flush();