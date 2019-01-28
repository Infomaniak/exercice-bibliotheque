<?php
namespace Library\db_filling_scripts;

require_once __DIR__.'/../src/Controllers/book.php';
use function Library\Controllers\create_book;


function create_books ($categories, $publishers, $authors){
    $books = array();
    $lorem = " is a great book about something great ! Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a risus a neque venenatis placerat nec vitae nunc. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut magna tellus, venenatis vitae viverra in, rutrum eget elit. Sed justo ante, aliquam et posuere nec, porttitor et lacus. Nam mollis gravida mi, nec viverra nisl pellentesque id. Nulla at sapien dictum, iaculis erat eu, ornare sem.";
    foreach (range(0, 9) as $index) {
        $title = "Book ".$index;
        $synopsis = $title.$lorem;
        $date =   \DateTime::createFromFormat("d/m/Y","25/04/2015");
        $books[$index] = create_book($categories[$index%3], $publishers[$index%3],$title, $date,
            "http://www.test.com/test123", $synopsis,$authors);
    }
    return $books;
}
