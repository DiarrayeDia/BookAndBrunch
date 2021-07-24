<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BooksController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(BookRepository $bookRepository): Response
    {
        $books = $bookRepository->findAll();

        return $this->render('books/index.html.twig', [
            'books' => $books,
        ]);
    }

    /**
     * @Route("/book/{id}", name="book_view", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function book_view($id): Response
    {
        return $this->render('books/book_view.html.twig', [
            'controller_name' => 'BooksController',
        ]);
    }
    // Book management in the back office 

    /**
     * @Route("/admin/book", name="book_index")
     */
    public function index(BookRepository $bookRepository): Response
    {
        return $this->render('admin/book/index.html.twig', [
            'books' => $bookRepository->findAll(),
            // là on ne remplit pas une variable
        ]);
    }

    /**
     * @Route("/admin/book/add", name="book_add")
     */
    public function addBook(Request $request): Response
    {
        $book = new Book();
        $bookform = $this->createForm(BookType::class, $book);
        $bookform->handleRequest($request);
        if ($bookform->isSubmitted() && $bookform->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush();
            $this->addFlash('success', 'Votre livre a été ajouté avec succès !');
            return $this->redirectToRoute('book_index');
        }
        return $this->render('admin/book/add.html.twig', [
            'form' => $bookform->createView(),
        ]);
    }

    /**
     * @Route("/admin/book/update/{id}", name="book_update", requirements={"id"="\d+"})
     */
    public function updateBook(Book $book, Request $request): Response
    {
        $bookform = $this->createForm(BookType::class, $book);
        $bookform->handleRequest($request);
        if ($bookform->isSubmitted() && $bookform->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush();
            $this->addFlash('success', 'Votre livre a été modifié avec succès !');
            return $this->redirectToRoute('book_index');
        }
        return $this->render('admin/book/add.html.twig', [
            'form' => $bookform->createView(),
        ]);
    }

    /**
     * @Route("/admin/book/delete/{id}", name="book_delete", requirements={"id"="\d+"})
     */
    public function delete(Book $book): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($book);
        $em->flush();
        $this->addFlash('success', 'Cette zone a été supprimée !');
        return $this->redirectToRoute('book_index');
    }
}
