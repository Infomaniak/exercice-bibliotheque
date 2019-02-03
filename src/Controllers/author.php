<?php
namespace Library\Controllers;

use Library\Models\Author;
require_once __DIR__ . '/entity.php'; //entitymanager used in entity

function create_author($name, $books = null){
    global $entityManager;
    $authorRepo = $entityManager->getRepository(Author::class);
    $author = $authorRepo->findOneBy(["name" => $name]);
    if($author == null) { //if author isn't already in database
        $author = new Author();
        $author->setName($name);
        $author->addBooks($books);
    }
    return $author;
}

function get_all_authors(){
    global $entityManager;
    $repo = $entityManager->getRepository(Author::class);
    return $repo->findAll();
}