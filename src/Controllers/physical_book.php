<?php
namespace Library\Controllers;

use Library\Models\Physical_Book;
require_once __DIR__ . '/entity.php'; //entitymanager used in entity

function create_physical_book($book){
    $physical_book = new Physical_Book();
    if($book != null) {
        $physical_book->setBook($book);
    }
    //no need to set the id because it's done by setBook
    return $physical_book;
}