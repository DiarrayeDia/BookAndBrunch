<?php

namespace App\Controller\Admin;

use App\Form\BookshelfType;
use App\Entity\Bookshelf;

use App\Repository\BookshelfRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookshelfController extends AbstractController

{
    /**
     * @Route("/bookshelf", name="bookshelf_view")
     */
    public function bookshelf_view(): Response
    {
        return $this->render('bookshelves/bookshelf_view.html.twig', [
            'controller_name' => 'BookshelfController',
        ]);
    }
    // Book management in the back office 

    /**
     * @Route("/admin/bookshelf", name="bookshelf_index")
     */
    public function index(BookshelfRepository $bookshelfRepository): Response
    {
        return $this->render('admin/bookshelf/index.html.twig', [
            'bookshelves' => $bookshelfRepository->findAll(),
            // là on ne remplit pas une variable
        ]);
    }

    /**
     * @Route("/admin/bookshelf/add", name="bookshelf_add")
     */
    public function addBookshelf(Request $request): Response
    {
        $bookshelf = new Bookshelf();
        $bookshelfform = $this->createForm(BookshelfType::class, $bookshelf);
        $bookshelfform->handleRequest($request);
        if ($bookshelfform->isSubmitted() && $bookshelfform->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bookshelf);
            $em->flush();
            $this->addFlash('success', 'Votre étagère a été ajoutée avec succès !');
            return $this->redirectToRoute('bookshelf_index');
        }
        return $this->render('admin/bookshelf/add.html.twig', [
            'form' => $bookshelfform->createView(),
        ]);
    }

    /**
     * @Route("/admin/bookshelf/update/{id}", name="bookshelf_update", requirements={"id"="\d+"})
     */
    public function updateBookshelf(Bookshelf $bookshelf, Request $request): Response
    {
        $bookshelfform = $this->createForm(BookshelfType::class, $bookshelf);
        $bookshelfform->handleRequest($request);
        if ($bookshelfform->isSubmitted() && $bookshelfform->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bookshelf);
            $em->flush();
            $this->addFlash('success', 'Votre étagère a été modifiée avec succès !');
            return $this->redirectToRoute('bookshelf_index');
        }
        return $this->render('admin/bookshelf/add.html.twig', [
            'form' => $bookshelfform->createView(),
        ]);
    }

    /**
     * @Route("/admin/bookshelf/delete/{id}", name="bookshelf_delete", requirements={"id"="\d+"})
     */
    public function delete(Bookshelf $bookshelf): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($bookshelf);
        $em->flush();
        $this->addFlash('success', 'Cette étagère a été supprimée !');
        return $this->redirectToRoute('bookshelf_index');
    }
}
