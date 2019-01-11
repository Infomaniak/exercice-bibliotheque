<?php
namespace Library\Controllers;

use Library\Models\Publisher;
require_once "utils.php"; //entitymanager used in utils

function create_publisher($name, $books = null){
    global $entityManager;
    $publisherRepo = $entityManager->getRepository(Publisher::class);
    $publisher = $publisherRepo->findOneBy(["name" => $name]);
    if($publisher == null) { //if publisher isn't already in database
        $publisher = new Publisher();
        $publisher->setName($name);
        $publisher->addBooks($books);
        return $publisher;
    }
    else{
        dialogBox_and_redirect('Error, name already taken, publisher not created.');
        header("Refresh:0");
        return null;
    }
}