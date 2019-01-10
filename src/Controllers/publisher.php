<?php
namespace Library\Controllers;

use Doctrine\ORM\ORMException;
use Library\Models\Publisher;
require_once "utils.php";

$entityManager = require '../../bootstrap.php';

function create_publisher($name, $books = null){
    global $entityManager;
    $publisherRepo = $entityManager->getRepository(Publisher::class);
    $publisher = $publisherRepo->findOneBy(["name" => $name]);
    if($publisher == null) { //if publisher isn't already in database
        $publisher = new Publisher();
        $publisher->setName($name);
        $publisher->addBooks($books);
        try {
            $entityManager->persist($publisher);
            $entityManager->flush();
            dialogBox_and_redirect("Publisher created !");
            header("Refresh:0");
            return $publisher;
        } catch (ORMException $e) {
            dialogBox_and_redirect("Error accessing database. \n $e");
            header("Refresh:0");
            return null;
        }
    }
    else{
        dialogBox_and_redirect('Error, name already taken, publisher not created.');
        header("Refresh:0");
        return null;
    }
}