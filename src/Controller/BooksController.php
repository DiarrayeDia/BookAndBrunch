<?php

namespace App\Controller;

use App\Entity\Books;
use App\Repository\BooksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
}
