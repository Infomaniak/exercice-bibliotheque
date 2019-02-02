<?php
require_once __DIR__.'/header.php';
$currentPage = "my_account";
require_once __DIR__.'/navbar.php';
require_once __DIR__.'/display_book.php';
$user = $entityManager->merge($_SESSION['user']);
?>
<h1 class="display-3 d-flex justify-content-center text-success">This page is yours !</h1>
<h2 class="display-4">See your informations</h2>
<p><span class="font-weight-bold">Your first name :</span> <?=  $user->getFirstname();?></p>
<p><span class="font-weight-bold">Your last name :</span> <?=  $user->getLastname();?></p>
<p><span class="font-weight-bold">Your mail address :</span> <?=  $user->getMail();?></p>
<p><span class="font-weight-bold">Your role :</span> <?=  $user->getRole();?></p>
<h2 class="display-4">Browse the books you borrowed</h2>
<?php
foreach ($user->getPhysicalBooks() as $pBook){
    $book = $pBook->getBook();
    display_book($book,$currentPage,$_SESSION['token']);
}

require_once __DIR__.'/footer.php';
?>
