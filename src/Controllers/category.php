<?php
namespace Library\Controllers;

use Library\Models\Category;
require_once "utils.php"; //entitymanager used in utils

function create_category($name, $books = null){
    global $entityManager;
    $categoryRepo = $entityManager->getRepository(Category::class);
    $category = $categoryRepo->findOneBy(["name" => $name]);
    if($category == null) { //if category isn't already in database
        $category = new Category();
        $category->setName($name);
        $category->addBooks($books);
        return $category;
    }
    else{
        dialogBox_and_redirect('Error, name already taken, category not created.');
        header("Refresh:0");
        return null;
    }
}