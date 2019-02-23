<?php
namespace Library\db_filling_scripts;

require_once __DIR__.'/../src/Controllers/publisher.php';
use function Library\Controllers\create_publisher;

function create_publishers (){
    $publishers = array();
    foreach (range(0, 2) as $index) {
        $publishers[$index] = create_publisher("Publisher".$index);
    }
    return $publishers;
}