<?php
require_once __DIR__.'/header.php';
require_once __DIR__.'/../Controllers/book.php';
use function Library\Controllers\random_books;
require_once __DIR__.'/display_book.php';
?>

<!------------------------------ NAVBAR ------------------------------>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
    <a class="navbar-brand" href="#">YouLib</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav col-lg-2">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Browse books
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">By category</a>
                    <a class="dropdown-item" href="#">By publisher</a>
                    <a class="dropdown-item" href="#">By author</a>
                </div>
            </li>
        </ul>
        <form class="form-inline col">
            <input class="form-control mr-sm-1 col" type="search" placeholder="Search a book" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <ul class="navbar-nav">

        <?php if(isset($_SESSION["user"])) : ?>

            <li class="nav-item">
                <a class="nav-link" href="#">My Account</a>
            </li>

            <?php if($_SESSION["user"]->getRole() == "librarian" || $_SESSION["user"]->getRole() == "admin") : ?>
                <li class="nav-item">
                    <a class="nav-link" href="#">Librarian corner</a>
                </li>
            <?php endif; ?>

            <form method="post" action="" class="form-inline" >
                <button class="btn btn-outline-danger navbar-btn" type="submit" name="submit" value="log_out">Log out</button>
            </form>

        <?php else: ?>

            <li class="nav-item">
                <a class="nav-link" data-toggle="modal" href="#modalReg">Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="modal" href="#modalSignIn">Sign in</a>
            </li>

        <?php endif; ?>
        </ul>

    </div>

</nav>
<!------------------------------ END NAVBAR ------------------------------>


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
require __DIR__.'/footer.php';
?>