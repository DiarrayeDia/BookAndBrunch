<?php

namespace App\Controller;

use App\Entity\Bookshelf;
use App\Form\BookshelfType;
use App\Repository\BooksRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BooksController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(BooksRepository $booksRepository): Response
    {
        $books = $booksRepository->findAll();

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
     * @Route("/bookshelf/add", name="bookshelf_add")
     */
    public function add_bookshelf(Request $request): Response
    {
        $bookshelf = new Bookshelf();
        $bookshelfform = $this->createForm(BookshelfType::class, $bookshelf);
        $bookshelfform->handleRequest($request);
        if ($bookshelfform->isSubmitted() && $bookshelfform->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bookshelf);
            $em->flush();
            $this->addFlash('success', 'Votre étagère a été ajoutée avec succès !');
            return $this->redirectToRoute('home');
        }
        return $this->render('admin/bookshelf/add.html.twig', [
            'form' => $bookshelfform->createView(),
        ]);
    }
}
