<?php
require_once __DIR__.'/../Controllers/book.php';
require_once __DIR__.'/../Controllers/physical_book.php';
use function Library\Controllers\{get_number_free_phys_books,is_user_holder,get_borrow_date};

function display_book($book,$nextPage,$token=null){
?>
    <div class="d-inline-flex border">
        <div class="col-sm-3">
         <img src="<?= $book->getCover(); ?>" alt="Book's cover picture" class="img-fluid">
        </div>
        <div class="col-sm-9">
            <h4><?= $book->getTitle(); ?></h4>
            <p>From category <?= $book->getCategory()->getName(); ?></p>
            <p>Written by <?php
                $authors = $book->getAuthors();
                for($i = 0 ; $i<count($authors)-2 ; $i++){
                    echo $authors[$i]->getName() .", ";
                }
                echo $authors[count($authors)-1]->getName();
                ?></p>
            <p>Published by <?= $book->getPublisher()->getName(); ?></p>
            <p>Release date : <?= $book->getReleaseDate()->format('F d, Y');?></p>
            <h5>Synopsis :</h5>
            <p><?= $book->getSynopsis(); ?></p>
            <p><?php
            $physical_books = $book->getPhysicalBooks();
            $nFreePhysBooks = get_number_free_phys_books($physical_books);
            echo $nFreePhysBooks ."/". count($physical_books) . " book(s) remaining";
            if(isset($_SESSION["user"]) && is_user_holder($physical_books, $_SESSION["user"])) :
                echo ". Borrowed since ".get_borrow_date($_SESSION["user"],$book->getId())->format('F d, Y').".";?></p>
                <form method="post" action="../Controllers/physical_book.php?returnB=true" class="form-inline" >
                    <input type="hidden" name="token" value="<?= $token; ?>" />
                    <input type="hidden" name="nextP" value="<?=$nextPage;?>" />
                    <button class="btn btn-outline-success" type="submit" name="return_book" value="<?= $book->getId() ;?>">Return book</button>
                </form>
                <a class="btn btn-outline-success" href="<?= $book->getPdf(); ?>" target="_blank">See PDF</a>
            <?php elseif(isset($_SESSION["user"]) && $nFreePhysBooks > 0): ?>
                <form method="post" action="../Controllers/physical_book.php?borrowB=true" class="form-inline" >
                    <input type="hidden" name="token" value="<?= $token; ?>" />
                    <input type="hidden" name="nextP" value="<?=$nextPage;?>" />
                    <button class="btn btn-outline-success" type="submit" name="borrow_book" value="<?= $book->getId() ;?>">Borrow book</button>
                </form>
            <?php elseif(!isset($_SESSION["user"])): ?>
                <p class="font-weight-bold">Please connect to borrow a book.</p>
            <?php endif; ?>

        </div>
    </div>
<?php
}
?>