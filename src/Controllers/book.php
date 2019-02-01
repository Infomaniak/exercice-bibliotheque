<?php
namespace Library\Controllers;

use Library\Models\Book;

require_once __DIR__ . '/entity.php'; //entitymanager used in entity

function create_book($category, $publisher, $title, $release_date, $pdf, $synopsis, $cover, $authors = null){
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
        $book->setCover($cover);
        $book->addAuthors($authors);
    }
    return $book;
}

/** Helper for random_book()
 * @param $min
 * @param $max
 * @param $quantity
 * @return array
 */
function unique_random_numbers_within_range($min, $max, $quantity) {
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}

/**
 * @param $number : the number of random books to get
 * @return array(Book) randomly chosen
 * @throws \Doctrine\ORM\NonUniqueResultException
 */
function random_books($number){
    global $entityManager;
    $repo = $entityManager->getRepository(Book::class);
    $totalRows = $repo->createQueryBuilder('a')->select('count(a.id)')->getQuery()->getSingleScalarResult();
    $random_ids = unique_random_numbers_within_range(1,$totalRows,$number);

    $books = $repo->createQueryBuilder('a')
        ->where('a.id IN (:ids)')
        ->setParameter('ids', $random_ids)
        ->setMaxResults($number)
        ->getQuery()
        ->getResult();

    return $books;
}