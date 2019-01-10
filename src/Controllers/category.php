<?php
namespace Library\Controllers;

use Doctrine\ORM\ORMException;
use Library\Models\Category;
require_once "utils.php";

$entityManager = require '../../bootstrap.php';

function create_category($name, $books = null){
    global $entityManager;
    $categoryRepo = $entityManager->getRepository(Category::class);
    $category = $categoryRepo->findOneBy(["name" => $name]);
    if($category == null) { //if category isn't already in database
        $category = new Category();
        $category->setName($name);
        $category->addBooks($books);
        try {
            $entityManager->persist($category);
            $entityManager->flush();
            dialogBox_and_redirect("Category created !");
            header("Refresh:0");
            return $category;
        } catch (ORMException $e) {
            dialogBox_and_redirect("Error accessing database. \n $e");
            header("Refresh:0");
            return null;
        }
    }
    else{
        dialogBox_and_redirect('Error, name already taken, category not created.');
        header("Refresh:0");
        return null;
    }
}