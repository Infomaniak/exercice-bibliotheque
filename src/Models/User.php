<?php

namespace Library\Models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(
        name="users",
        indexes={
        @ORM\Index(name="search_firstname_lastname", columns={"first_name", "last_name"}),
        @ORM\Index(name="search_role", columns={"role"})
        }
    )
 */
class User
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $first_name;

    /**
     * @ORM\Column(type="string")
     */
    protected $last_name;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(64) NOT NULL")
     */
    protected $password;

    /**
     * @ORM\Column(type="string", unique = true)
     */
    protected $mail;

    /**
     * @ORM\Column(type="string")
     */
    protected $role;

    /**
     * @ORM\OneToMany(targetEntity=Physical_Book::class, cascade={"persist", "remove"}, mappedBy="holder")
     */
    protected $physical_books;

    public function __construct()
    {
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

    public function getFirstname()
    {
        return $this->first_name;
    }

    public function setFirstname($firstname)
    {
        $this->first_name = $firstname;
    }

    public function getLastname()
    {
        return $this->last_name;
    }

    public function setLastname($lastname)
    {
        $this->last_name = $lastname;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $password = hash("sha256", $password); //password is encrypted before it's set
        $this->password = $password;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
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
        $format = "User (id: %s, first_name: %s, last_name: %s, role: %s, mail: %s)\n";
        return sprintf($format, $this->id, $this->first_name, $this->last_name, $this->role, $this->mail);
    }

}