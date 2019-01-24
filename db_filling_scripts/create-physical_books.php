<?php
namespace Library\db_filling_scripts;

require_once __DIR__.'/../src/Controllers/physical_book.php';
use function Library\Controllers\create_physical_book;

function create_physical_books ($books){
    $physical_books = array();
    $i = 0;
    foreach ($books as $book) {
        foreach(range(0, 9) as $index) {
            $physical_books[$i+$index] = create_physical_book($book);
        }
        $i+=10;
    }
    return $physical_books;
}
