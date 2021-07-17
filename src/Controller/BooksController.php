<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BooksController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        return $this->render('books/index.html.twig', [
            'controller_name' => 'BooksController',
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
