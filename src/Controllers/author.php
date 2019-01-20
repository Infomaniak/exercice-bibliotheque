<?php
namespace Library\Controllers;

use Library\Models\Author;
require_once __DIR__.'/utils.php'; //entitymanager used in utils

function create_author($name, $books = null){
    global $entityManager;
    $authorRepo = $entityManager->getRepository(Author::class);
    $author = $authorRepo->findOneBy(["name" => $name]);
    if($author == null) { //if author isn't already in database
        $author = new Author();
        $author->setName($name);
        $author->addBooks($books);
        return $author;
    }
    else{
        dialogBox_and_redirect('Error, name already taken, author not created.');
        header("Refresh:0");
        return null;
    }
}