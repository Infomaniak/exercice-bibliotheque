<?php
namespace Library\Controllers;

use Library\Models\Publisher;
require_once __DIR__ . '/entity.php'; //entitymanager used in entity

function create_publisher($name, $books = null){
    global $entityManager;
    $publisherRepo = $entityManager->getRepository(Publisher::class);
    $publisher = $publisherRepo->findOneBy(["name" => $name]);
    if($publisher == null) { //if publisher isn't already in database
        $publisher = new Publisher();
        $publisher->setName($name);
        $publisher->addBooks($books);
    }
    return $publisher;
}

function get_all_publishers(){
    global $entityManager;
    $repo = $entityManager->getRepository(Publisher::class);
    return $repo->findAll();
}