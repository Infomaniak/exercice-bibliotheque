<?php
$entityManager = require_once join(DIRECTORY_SEPARATOR, ['bootstrap.php']);

use Library\Models\User;

$identifiant = 2;

$userRepo = $entityManager->getRepository(User::class);

$user = $userRepo->find($identifiant);

$entityManager->remove($user);
$entityManager->flush($user);

$user = $userRepo->find($identifiant);

var_dump($user);