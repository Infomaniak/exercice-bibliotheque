<?php
namespace Library\Controllers;

use Library\Models\Category;
require_once __DIR__ . '/entity.php'; //entitymanager used in entity

function create_category($name, $books = null){
    global $entityManager;
    $categoryRepo = $entityManager->getRepository(Category::class);
    $category = $categoryRepo->findOneBy(["name" => $name]);
    if($category == null) { //if category isn't already in database
        $category = new Category();
        $category->setName($name);
        $category->addBooks($books);
    }
    return $category;
}

function get_all_categories(){
    global $entityManager;
    $repo = $entityManager->getRepository(Category::class);
    return $repo->findAll();
}