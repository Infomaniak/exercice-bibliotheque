<?php

$entityManager = require_once join(DIRECTORY_SEPARATOR, ['bootstrap.php']);

use Library\Models\User;

$user = new User();
$user->setFirstname("Admin ");
$user->setLastname("Nimda ");
$user->setMail("admin.minda@test.com");
$user->setPassword("test1234");
$user->setRole("admin");
$entityManager->persist($user);

foreach (range(1, 10) as $index) {
    $user = new User();
    $user->setFirstname("First ".$index);
    $user->setLastname("LAST ".$index);
    $user->setMail("fist.last.".$index."@test.com");
    $user->setPassword("test123");
    $user->setRole("user");
    $entityManager->persist($user);
}

$entityManager->flush();