<?php
require_once __DIR__.'/header.php';
$currentPage = "librarian_corner";
require_once __DIR__.'/navbar.php';
require_once __DIR__.'/../Controllers/book.php';
use function Library\Controllers\{get_all_books,get_taken_phys_books};

if(isset($_SESSION['user']) && $_SESSION['user']->getRole() == "librarian") :
?>

<h2>Edit books</h2>
<button class="btn btn-outline-success my-2 my-sm-0" id="addBook">Add book</button>
<table id="editBooks" class="table table-striped table-bordered" style="width:99%">
    <thead>
        <tr>
            <th>Title</th>
            <th>Category</th>
            <th>Authors</th>
            <th>Publisher</th>
            <th>Release date</th>
            <th>Synopsis</th>
            <th>Cover picture</th>
            <th>Pdf</th>
            <th>Quantity</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach(get_all_books() as $book): ?>
    <tr>
        <td><?= htmlspecialchars($book->getTitle());?></td>
        <td><?= htmlspecialchars($book->getCategory()->getName());?></td>
        <td><?php
            $authors = $book->getAuthors();
            for($i=0 ; $i<count($authors) ; $i++) {
                if($i != count($authors)-1) {
                    echo htmlspecialchars($authors[$i]->getName()) . ", ";
                }
                else{
                    echo htmlspecialchars($authors[$i]->getName());
                }
            }?></td>
        <td><?= htmlspecialchars($book->getPublisher()->getName());?></td>
        <td><?= $book->getReleaseDate()->format('Y-m-d');?></td>
        <td width="35%"><?= htmlspecialchars($book->getSynopsis());?></td>
        <td><?= htmlspecialchars($book->getCover());?></td>
        <td><?= htmlspecialchars($book->getPdf());?></td>
        <td><?= count($book->getPhysicalBooks());?></td>
        <td>
            <i class="fa fa-pencil-square" aria-hidden="true" style="cursor: pointer"></i>
            <i class="fa fa-minus-square" aria-hidden="true" style="cursor: pointer"></i>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Title</th>
            <th>Category</th>
            <th>Authors</th>
            <th>Publisher</th>
            <th>Synopsis</th>
            <th>Cover picture</th>
            <th>Quantity</th>
        </tr>
    </tfoot>
</table>


<hr>
<h2>See who borrowed what</h2>
    <table id="seeHolders" class="table table-striped table-bordered" style="width:99%">
        <thead>
        <tr>
            <th>Book title</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Mail</th>
            <th>Borrow date</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach(get_all_books() as $book):
                foreach(get_taken_phys_books($book->getPhysicalBooks()) as $pBook):
                    $holder = $pBook->getHolder()?>
            <tr>
                <td><?= htmlspecialchars($book->getTitle());?></td>
                <td><?= htmlspecialchars($holder->getFirstname());?></td>
                <td><?= htmlspecialchars($holder->getLastname());?></td>
                <td><?= htmlspecialchars($holder->getMail());?></td>
                <td><?= $pBook->getBorrowDate()->format('Y-m-d');?></td>
            </tr>
        <?php endforeach;
                endforeach;?>
        </tbody>
        <tfoot>
        <tr>
            <th>Book title</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Mail</th>
            <th>Borrow date</th>
        </tr>
        </tfoot>
    </table>

<?php
else :
    echo "<p>You must be connected as a librarian to access to this page.</p><a href='index.php'>Return to index.php</a>";
endif;
require_once __DIR__.'/footer.php'
?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="js/librarian_utils.js"></script>

