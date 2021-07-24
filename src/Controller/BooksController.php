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
            return $this->redirectToRoute('admin_home');
        }
        return $this->render('admin/book/add.html.twig', [
            'form' => $bookform->createView(),
        ]);
    }
}
