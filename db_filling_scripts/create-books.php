<?php
namespace Library\db_filling_scripts;

require_once __DIR__.'/../src/Controllers/book.php';
use function Library\Controllers\create_book;


function create_books ($categories, $publishers, $authors){
    $books = array();
    foreach (range(0, 9) as $index) {
        $date =   \DateTime::createFromFormat("d/m/Y","25/04/2015");
        $books[$index] = create_book($categories[$index%3], $publishers[$index%3],"Book ".$index, $date,
            "http://www.test.com/test123",$authors);
    }
    return $books;
}
