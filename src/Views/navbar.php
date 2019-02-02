<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
    <a class="navbar-brand" href="index.php">YouLib</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav col-lg-2">
            <li class="nav-item <?php if ($currentPage=="index") echo "active"; ?>">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?php if ($currentPage=="browse_books") echo "active"; ?>" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Browse books</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="browse_books.php?by=category">By category</a>
                    <a class="dropdown-item" href="browse_books.php?by=publisher">By publisher</a>
                    <a class="dropdown-item" href="browse_books.php?by=author">By author</a>
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
                    <a class="nav-link <?php if ($currentPage=="my_account") echo "active"; ?>" href="my_account.php">My Account</a>
                </li>

                <?php if($_SESSION["user"]->getRole() == "librarian" || $_SESSION["user"]->getRole() == "admin") : ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($currentPage=="librarian_corner") echo "active"; ?>" href="librarian_corner.php">Librarian corner</a>
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

            <?php endif;
            //TODO : For the register form, do the double-password-check
            //TODO : For the sign in form, give a feedback if wrong password
            //TODO : In both forms : never trust user input !
            //TODO : In both forms : design
            ?>
        </ul>
    </div>
</nav>