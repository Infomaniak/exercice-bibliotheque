<?php

namespace Library\Models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="publishers")
 */
class Publisher extends Model_IdName
{

    /**
     * @ORM\OneToMany(targetEntity=Book::class, cascade={"persist", "remove"}, mappedBy="publisher")
     */
    protected $books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    public function getBooks()
    {
        return $this->books;
    }

    public function addBook(Book $book)
    {
        if(!$this->books->contains($book)) {
            $this->books->add($book);
            $book->setPublisher($this);
        }
    }

    public function addBooks($books){
        if($books != null) {
            foreach ($books as $book) {
                $this->addBook($book);
            }
        }
    }

    public function __toString()
    {
        $format = "Publisher (id: %s, name: %s)\n";
        return sprintf($format, $this->id, $this->name);
    }

}