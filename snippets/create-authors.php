<?php

$entityManager = require_once join(DIRECTORY_SEPARATOR, ['bootstrap.php']);

use Library\Models\Author;



foreach (range(1, 10) as $index) {
    $author = new Author();
    $author->setName("Name".$index);
    $entityManager->persist($author);
}

$entityManager->flush();