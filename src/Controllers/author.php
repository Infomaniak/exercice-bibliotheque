<?php
namespace Library\Controllers;

use Doctrine\ORM\ORMException;
use Library\Models\Author;
require_once "utils.php";

$entityManager = require '../../bootstrap.php';

function create_author($name, $books = null){
    global $entityManager;
    $authorRepo = $entityManager->getRepository(Author::class);
    $author = $authorRepo->findOneBy(["name" => $name]);
    if($author == null) { //if author isn't already in database
        $author = new Author();
        $author->setName($name);
        $author->addBooks($books);
        try {
            $entityManager->persist($author);
            $entityManager->flush();
            dialogBox_and_redirect("Author created !");
            header("Refresh:0");
            return $author;
        } catch (ORMException $e) {
            dialogBox_and_redirect("Error accessing database. \n $e");
            header("Refresh:0");
            return null;
        }
    }
    else{
        dialogBox_and_redirect('Error, name already taken, author not created.');
        header("Refresh:0");
        return null;
    }
}