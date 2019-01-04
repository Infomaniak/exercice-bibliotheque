<?php

$entityManager = require_once join(DIRECTORY_SEPARATOR, ['bootstrap.php']);

use Library\Models\User;

$identifiant = 11;

$userRepo = $entityManager->getRepository(User::class);

$user = $userRepo->find($identifiant);

$user->setFirstname("First Real Modification");
$user->setLastname("Last Real Modification");

$entityManager->flush();