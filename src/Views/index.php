<?php
require_once __DIR__.'/header.php';
$currentPage = "index";
require_once __DIR__.'/navbar.php';
require_once __DIR__.'/../Controllers/book.php';
use function Library\Controllers\random_books;
require_once __DIR__.'/display_book.php';
?>

<h1 class="display-1 d-flex justify-content-center text-success">Welcome to YouLib <?php if(isset($_SESSION["user"])) echo $_SESSION["user"]->getFirstName()?> !</h1>
<h3 class="display-4 d-flex justify-content-end text-secondary">You don't know what to read ?</h3>
<h2 class="display-3 d-flex justify-content-start text-primary">Here is a selection of 3 random books !</h2>

<?php
$books = random_books(3);
foreach ($books as $book) {
    if(isset($_SESSION['token'])) {
        display_book($book, $_SESSION['token']);
    }
    else{
        display_book($book);
    }
}
?>

<?php
require_once __DIR__.'/footer.php';
?>