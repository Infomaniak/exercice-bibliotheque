<?php

$entityManager = require_once join(DIRECTORY_SEPARATOR, ['bootstrap.php']);

use Library\Models\Author;

$authorRepo = $entityManager->getRepository(Author::class);

$author = $authorRepo->find(1);

echo "Author by primary key:\n";
echo $author;

$allAuthors = $authorRepo->findAll();
echo "All users:\n";
foreach ($allAuthors as $author) {
    echo $author;
}
