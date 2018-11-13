<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use App\Entity\Book;
use App\Entity\User;
use App\Repository\BookRepository;

class BookController extends AbstractController
{
    /**
     * @Route("/book", name="book")
     */
    public function index(BookRepository $repo)
    {
    	$books = $repo->findAll();

        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
            'books' => $books
        ]);
    }

    /**
     * @Route("/book/borrow/{id}", name="borrow_book")
     */
    public function borrow(Book $book)
    {
        if(!$book->getUser()){
            // Pour récupérer l'utilisateur connecté
            $user = $this->getUser();
            $user->addBook($book);

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();
        }

        return $this->redirectToRoute('book');
    }
}
