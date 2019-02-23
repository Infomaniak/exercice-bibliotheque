<?php

require_once __DIR__.'/header.php';
$currentPage = "browse_books.php";
require_once __DIR__.'/navbar.php';

require_once __DIR__.'/../Controllers/author.php';
require_once __DIR__.'/../Controllers/category.php';
require_once __DIR__.'/../Controllers/publisher.php';
require_once __DIR__.'/../Controllers/book.php';
require_once __DIR__.'/display_book.php';
use function Library\Controllers\get_all_authors;
use function Library\Controllers\get_all_categories;
use function Library\Controllers\get_all_publishers;
use function Library\Controllers\get_by;

if(isset($_GET['by'])){
    if(!isset($_GET['what'])) {
        $currentPage = "browse_books.php?by=" . $_GET['by'];
        echo '<ul class="list-group list-group-flush">';
        switch ($_GET['by']) {
            case "Category":
                $categories = get_all_categories();
                foreach ($categories as $category) {
                    echo    '<li class="list-group-item text-center w-100">'.
                                '<a href="browse_books.php?by=' . $_GET['by'] . '&what=' . $category->getName() . '">' . $category->getName() . '</a>'.
                            '</li>';
                }
                break;
            case "Publisher":
                $publishers = get_all_publishers();
                foreach ($publishers as $publisher) {
                    echo    '<li class="list-group-item text-center w-100">'.
                                '<a href="browse_books.php?by=' . $_GET['by'] . '&what=' . $publisher->getName() . '">' . $publisher->getName() . '</a>'.
                            '</li>';
                }
                break;
            case "Author":
                $authors = get_all_authors();
                foreach ($authors as $author) {
                    echo    '<li class="list-group-item text-center w-100">'.
                                '<a href="browse_books.php?by=' . $_GET['by'] . '&what=' . $author->getName() . '">' . $author->getName() . '</a>'.
                            '</li>';
                }
                break;
        }
        echo "</ul>";
    }
    elseif($_GET['by'] == "Author" || $_GET['by'] == "Category" || $_GET['by'] == "Publisher") {
        $currentPage = "browse_books.php?by=" . $_GET['by'] . "&what=" . $_GET['what'];
        foreach (get_by($_GET['by'], $_GET['what']) as $book) {
            if(isset($_SESSION['token'])){
                display_book($book,$currentPage,$_SESSION['token']);
            }
            else{
                display_book($book,$currentPage);
            }
        }
    }
}

require_once __DIR__.'/footer.php';
?>
