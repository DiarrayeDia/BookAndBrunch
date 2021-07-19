<?php

namespace App\Controller\Admin;

use App\Entity\Books;
use App\Form\BookType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_home")
     */
    public function index(): Response
    {
        return $this->render('admin/book/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/book/add", name="book_add")
     */
    public function addBook(Request $request): Response
    {
        $book = new Books();
        $bookform = $this->createForm(BookType::class, $book);
        return $this->render('admin/book/add.html.twig', [
            'form' => $bookform->createView(),
        ]);
    }
}
