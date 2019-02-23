<?php

$entityManager = require_once join(DIRECTORY_SEPARATOR, ['bootstrap.php']);

use Library\Models\User;

$userRepo = $entityManager->getRepository(User::class);

$user = $userRepo->find(1);
echo "User by primary key \"1\":\n";
echo $user;

$allUsers = $userRepo->findAll();
echo "All users:\n";
foreach ($allUsers as $user) {
    echo $user;
}

//2 versions :
$usersByRole = $userRepo->findBy(["role" => "admin"]);
//$usersByRole = $userRepo->findByRole("admin");
echo "Users by role \"admin\":\n";
foreach ($usersByRole as $user) {
    echo $user;
}

$usersByRoleAndFirstName = $userRepo->findBy(["role" => "user", "first_name" => "First 2"]);
echo "Users by role \"user\" and firstName \"First 2\":\n";
foreach ($usersByRoleAndFirstName as $user) {
    echo $user;
}