<?php
namespace Library\Controllers;

use Library\Models\Physical_Book;

require_once "utils.php";

function create_physical_book($book){
    $physical_book = new Physical_Book();
    $physical_book->setBook($book);
    return $physical_book;
}