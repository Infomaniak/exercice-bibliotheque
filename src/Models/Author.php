<?php

namespace Library\Models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="authors", options={"charset":"utf8mb4", "collate":"utf8mb4_unicode_ci"})
 */
class Author extends Model_IdName
{

    /**
     * Many Authors have Many Books.
     * @ORM\ManyToMany(targetEntity=Book::class, inversedBy="authors")
     * @ORM\JoinTable(name="books_authors")
     */
    protected $books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    public function __toString()
    {
        $format = "Author (id: %s, name: %s)\n";
        return sprintf($format, $this->id, $this->name);
    }

    public function getBooks()
    {
        return $this->books;
    }

    public function addBook(Book $book)
    {
        if(!$this->books->contains($book)) {
            $this->books->add($book);
            $book->addAuthor($this);
        }
    }

    public function addBooks($books){
        if($books != null) {
            foreach ($books as $book) {
                $this->addBook($book);
            }
        }
    }

    public function removeBook(Book $book)
    {
        if($this->books->contains($book)) {
            $this->books->removeElement($book);
            $book->removeAuthor($this);
        }
    }

}