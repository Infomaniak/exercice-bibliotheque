<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use App\Repository\UserRepository;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(BookRepository $bookRepository, UserRepository $userRepository)
    {
        $books = $bookRepository->findAll();
        $users = $userRepository->findAll();

        return $this->render('admin/index.html.twig', [
            'books' => $books,
            'users' => $users
        ]);
    }

    /**
     * @Route("/admin/edit/{id}", name="admin_edit_book")
     */
    public function editBook(Book $book, Request $request)
    {
        $form = $this->createForm(BookType::class, $book);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/edit.html.twig', [
            'book' => $book,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/delete/{id}", name="admin_delete_book")
     */
    public function deleteBook(Book $book)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($book);
        $em->flush();

        return $this->redirectToRoute('admin');
    }

    /**
     * @Route("/admin/add", name="admin_add_book")
     */
    public function addBook(Request $request)
    {
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/add.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
