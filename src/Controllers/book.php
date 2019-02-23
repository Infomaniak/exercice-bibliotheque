<?php
namespace Library\Controllers;

use Doctrine\Common\Collections\ArrayCollection;
use function Library\db_filling_scripts\create_authors;
use Library\Models\Book;

require_once __DIR__ . '/entity.php'; //entitymanager used in entity
require_once __DIR__ . '/category.php';
require_once __DIR__ . '/author.php';
require_once __DIR__ . '/publisher.php';
require_once __DIR__ . '/physical_book.php';

function create_book($category, $publisher, $title, $release_date, $pdf, $synopsis, $cover, $authors = null){
    global $entityManager;
    $bookRepo = $entityManager->getRepository(Book::class);
    $book = $bookRepo->findOneBy(["title" => $title]);
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

function get_all_books(){
    global $entityManager;
    $repo = $entityManager->getRepository(Book::class);
    return $repo->findAll();
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
    $books = array();
    $allBooks = get_all_books();
    $totalRows = count($allBooks);
    $random_ids = unique_random_numbers_within_range(1,$totalRows,$number);
    $count = 0;
    foreach($random_ids as $r_id){
        $books[$count] = $allBooks[$r_id-1];
        $count++;
    }
    return $books;
}


//if we come from librarian_utils.js to update (or create) a book
if(isset($_POST['action']) && $_POST['action'] == "save"){
   update_book($_POST['title'],$_POST['category'],$_POST['authors'],$_POST['publisher'],
        $_POST['release_date'],$_POST['synopsis'],$_POST['cover'],$_POST['pdf'],$_POST['quantity']);

}

/**
 * @param $title
 * @param $category
 * @param $authors
 * @param $publisher
 * @param $release_date
 * @param $synopsis
 * @param $cover
 * @param $pdf
 * @param $quantityAfter
 * @throws \Doctrine\ORM\ORMException
 * @throws \Doctrine\ORM\OptimisticLockException
 */
function update_book($title, $category, $authors, $publisher, $release_date, $synopsis, $cover, $pdf, $quantityAfter){
    global $entityManager;
    $bookRepo = $entityManager->getRepository(Book::class);
    $book = $bookRepo->findOneBy(["title" => $title]);

    //initialize all the sub-objects of the book :
    //all the "create_foo()" I need return the found object if already in database
    $category = create_category($category);
    $entityManager->persist($category);
    $publisher = create_publisher($publisher);
    $entityManager->persist($publisher);

    //clean authors' string
    $authors = preg_replace("/ {2,}/", " ", $authors); //cleans consecutive white-spaces
    $authors = str_replace( ', ', ',', $authors ); //avoid white-spaces at the beginning
    $authors = str_replace( ' ,', ',', $authors ); //or at the end of an author's name
    //then transform it to an array
    $authors = explode(",",$authors);
    for($i = 0 ; $i<count($authors) ; $i++) {
        $authors[$i] = create_author($authors[$i]);
        $entityManager->persist($authors[$i]);
    }
    $authors = new ArrayCollection($authors);
    $release_date = date_create_from_format('Y-m-d',$release_date);

    if($book != null) { //if book is in database, update :
        $category->addBook($book);
        foreach($book->getAuthors() as $author){
            $author->removeBook($book);
        }
        $book->setAuthors($authors);
        $publisher->addBook($book);
        $book->setReleaseDate($release_date);
        $book->setSynopsis($synopsis);
        $book->setCover($cover);
        $book->setPdf($pdf);
        $quantityBefore = count($book->getPhysicalBooks());
        $addOrRemovePBooks = $quantityAfter - $quantityBefore;
        if($addOrRemovePBooks>0){ //add pbooks
            for($i = 0 ; $i<$addOrRemovePBooks ; $i++) {
                $pbook = create_physical_book($book);
                $entityManager->persist($pbook);
            }
        }
        elseif ($addOrRemovePBooks<0){ //remove pbooks
            for($i = 0 ; $i>$addOrRemovePBooks ; $i--) {
                remove_physical_book($book);
            }
        }
    }
    else{ //if book not in database, create :
        $book = create_book($category,$publisher,$title,$release_date,$pdf,$synopsis,$cover,$authors);
        for($i=0 ; $i<$quantityAfter ; $i++){
            $pbook = create_physical_book($book);
            $entityManager->persist($pbook);
        }
        $entityManager->persist($book);
    }
    $entityManager->flush();
}

if(isset($_POST['action']) && $_POST['action'] == "remove") {
    remove_book($_POST['title']);
}
function remove_book($title){
    if($title != null) {
        global $entityManager;
        $bookRepo = $entityManager->getRepository(Book::class);
        $book = $bookRepo->findOneBy(["title" => $title]);
        if($book != null) {
            $entityManager->remove($book);
            $entityManager->flush();
        }
    }
}

function get_by($by, $what){
    global $entityManager;
    $repo = $entityManager->getRepository("Library\Models\\$by");
    $entity = $repo->findOneBy(['name' => $what]);
    if($by != "Author") {
        $bookRepo = $entityManager->getRepository(Book::class);
        return $bookRepo->findBy([strtolower($by) => $entity]);
    }
    else{ // I don't think it's the best way to do so but I haven't found a better solution yet...
        $books = get_all_books();
        $validBooks = array();
        $count = 0;
        foreach($books as $book){
            if($book->getAuthors()->contains($entity)){
                $validBooks[$count] = $book;
                $count++;
            }
        }
        return $validBooks;
    }
}