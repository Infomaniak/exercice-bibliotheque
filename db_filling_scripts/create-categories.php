<?php
namespace Library\db_filling_scripts;

require_once __DIR__.'/../src/Controllers/category.php';
use function \Library\Controllers\create_category;

function create_categories (){
    $categories = array();
    foreach (range(0, 2) as $index) {
        $categories[$index] = create_category("Category".$index);
    }
    return $categories;
}