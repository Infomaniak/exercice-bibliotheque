<?php
namespace Library\db_filling_scripts;

require_once __DIR__.'/create-categories.php';
require_once __DIR__.'/create-publishers.php';
require_once __DIR__.'/create-users.php';
require_once __DIR__.'/create-authors.php';
require_once __DIR__.'/create-books.php';
require_once __DIR__.'/create-physical_books.php';
require_once __DIR__ . '/../src/Controllers/entity.php';

use Library\Controllers\DatabaseException;
use function Library\Controllers\store_entities;

$categories = create_categories(); // 3 categories
$publishers = create_publishers(); // 3 publishers
$users = create_users(); // 20 users
$authors = create_authors(); // 10 authors
$books = create_books($categories,$publishers,$authors); // 10 books
$physical_books = create_physical_books($books); // 10 physical_book by book (100)


$entities = array_merge($categories,$publishers,$users,$authors,$books,$physical_books);
try {
    store_entities($entities);
} catch (DatabaseException $e) {
    echo $e;
}