<?php

namespace Library\Models;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="physical_books")
 */
class Physical_Book
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity=Book::class, inversedBy="physical_books")
     */
    protected $book;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="physical_books")
     */
    protected $holder;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $borrow_date;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getBook()
    {
        return $this->book;
    }

    public function setBook(Book $book)
    {
        $this->book = $book;
        $this->setId($book->getId());
    }

    public function getHolder()
    {
        return $this->holder;
    }

    public function setHolder($holder)
    {
        if($this->holder != null){
            $this->holder->removePhysicalBook($this);
        }
        else {
            $holder->addPhysicalBook($this);
        }
        $this->holder = $holder;
    }

    public function getBorrowDate()
    {
        return $this->borrow_date;
    }

    public function setBorrowDate($borrow_date)
    {
        $this->borrow_date = $borrow_date;
    }

    public function __toString()
    {
        $format = "Physical_Book (id: %s, book: %s, holder: %s)\n";
        return sprintf($format, $this->id, $this->book, $this->holder);
    }

}