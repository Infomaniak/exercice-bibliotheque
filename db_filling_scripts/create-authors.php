<?php
namespace Library\db_filling_scripts;

require_once __DIR__.'/../src/Controllers/author.php';
use function Library\Controllers\create_author;

function create_authors (){
    $authors = array();
    foreach (range(0, 9) as $index) {
        $authors[$index] = create_author("Author".$index);
    }
    return $authors;
}