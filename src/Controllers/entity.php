<?php
namespace Library\Controllers;

use Doctrine\ORM\ORMException;
require_once __DIR__.'/Exceptions/DatabaseException.php';
$entityManager = require __DIR__.'/../../bootstrap.php';

/**
 * @throws DatabaseException when the entity couldn't be stored
 */
function store_entity($entity){
    if($entity != null) {
        global $entityManager;
        try {
            $entityManager->persist($entity);
            $entityManager->flush();
        } catch (ORMException $e) {
            throw new DatabaseException("Couldn't store the entity");
        }
    }
}

/**
 * @throws DatabaseException when the entity couldn't be stored
 */
function store_entities($entities){
    global $entityManager;
    try {
        foreach ($entities as $entity) {
            if($entity != null) {
                $entityManager->persist($entity);
            }
        }
        $entityManager->flush();
    } catch (ORMException $e) {
        throw new DatabaseException("Couldn't store the entity");
    }
}