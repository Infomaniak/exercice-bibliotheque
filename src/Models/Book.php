<?php

namespace Library\Models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="books")
 */
class Book
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    protected $title;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="books")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $category;

    /**
     * @ORM\Column(type="date")
     */
    protected $release_date;

    /**
     * @ORM\ManyToOne(targetEntity=Publisher::class, inversedBy="books")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $publisher;

    /**
     * @ORM\Column(type="string")
     */
    protected $pdf;

    /**
     * Many Books have many Authors.
     * @ORM\ManyToMany(targetEntity=Author::class, mappedBy="books")
     */
    protected $authors;

    /**
     * @ORM\OneToMany(targetEntity=Physical_Book::class, cascade={"persist", "remove"}, mappedBy="book")
     */
    protected $physical_books;

    public function __construct()
    {
        $this->authors = new ArrayCollection();
        $this->physical_books = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getReleaseDate()
    {
        return $this->release_date;
    }

    public function setReleaseDate($release_date)
    {
        $this->release_date = $release_date;
    }

    public function getPublisher()
    {
        return $this->publisher;
    }

    public function setPublisher($publisher)
    {
        $this->publisher = $publisher;
    }

    public function getPdf()
    {
        return $this->pdf;
    }

    public function setPdf($pdf)
    {
        $this->pdf = $pdf;
    }

    public function getAuthors(){
        return $this->authors;
    }

    public function addAuthor(Author $author)
    {
        if(!$this->authors->contains($author)) {
            $this->authors->add($author);
            $author->addBook($this);
        }
    }

    public function removeAuthor(Author $author)
    {
        if($this->authors->contains($author)) {
            $this->authors->removeElement($author);
            $author->removeBook($this);
        }
    }

    public function getPhysicalBooks()
    {
        return $this->physical_books;
    }

    public function addPhysicalBooks(Physical_Book $physical_book)
    {
        if(!$this->physical_books->contains($physical_book)) {
            $this->physical_books->add($physical_book);
            $physical_book->setBook($this);
        }
    }

    public function __toString()
    {
        $format = "Book (id: %s, title: %s, category: %s, publisher: %s, pdf: %s)\n";
        return sprintf($format, $this->id, $this->title, $this->category, $this->publisher, $this->pdf);
    }



}