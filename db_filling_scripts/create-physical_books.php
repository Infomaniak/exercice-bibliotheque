<?php
namespace Library\db_filling_scripts;

require_once __DIR__.'/../src/Controllers/physical_book.php';
use function Library\Controllers\create_physical_book;

function create_physical_books ($books,$users){
    $physical_books = array();
    $i = 0;
    foreach ($books as $book) {
        foreach(range(0, 9) as $index) {
            $physical_books[$i+$index] = create_physical_book($book);
        }
        $i+=10;
    }
    $users[0]->addPhysicalBook($physical_books[0]);
    $users[0]->addPhysicalBook($physical_books[11]);
    $users[0]->addPhysicalBook($physical_books[21]);
    $users[0]->addPhysicalBook($physical_books[31]);
    return $physical_books;
}
