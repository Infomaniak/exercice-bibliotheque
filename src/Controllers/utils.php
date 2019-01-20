<?php
namespace Library\Controllers;

use Doctrine\ORM\ORMException;

$entityManager = require __DIR__.'/../../bootstrap.php';

function store_entity($entity){
    global $entityManager;
    try {
        $entityManager->persist($entity);
        $entityManager->flush();
        dialogBox_and_redirect("Entity stored !");
    } catch (ORMException $e) {
        dialogBox_and_redirect("Error accessing database. \n $e");
    }
}

function store_entities($entities){
    global $entityManager;
    try {
        foreach ($entities as $entity) {
            $entityManager->persist($entity);
        }
        $entityManager->flush();
        dialogBox_and_redirect("Entity stored !");
    } catch (ORMException $e) {
        dialogBox_and_redirect("Error accessing database. \n $e");
    }
}

function dialogBox_and_redirect($message, $pageChange = null){
    if($pageChange != null) {
        echo "<script type='text/javascript'> 
                alert(\"$message\");
                window.location.replace(\"$pageChange\"); 
              </script>";
    }
    else{
        echo "<script type='text/javascript'> 
                alert(\"$message\");
              </script>";
    }
}