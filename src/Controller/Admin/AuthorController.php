<?php

namespace App\Controller\Admin;

use App\Entity\Author;
use App\Form\AuthorType;
use App\Repository\AuthorRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AuthorController extends AbstractController
{
    /**
     * @Route("/admin/author", name="author_index")
     */
    public function index(AuthorRepository $authorRepository): Response
    {
        return $this->render('admin/author/index.html.twig', [
            'authors' => $authorRepository->findAll(),
            // là on ne remplit pas une variable
        ]);
    }


    /**
     * @Route("/author/add", name="author_add")
     */
    public function addAuthor(Request $request): Response
    {
        $author = new Author();
        $authorform = $this->createForm(AuthorType::class, $author);
        $authorform->handleRequest($request);
        if ($authorform->isSubmitted() && $authorform->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($author);
            $em->flush();
            $this->addFlash('success', 'Votre auteur.e a été ajouté.e avec succès !');
            return $this->redirectToRoute('admin_home');
        }
        return $this->render('admin/author/add.html.twig', [
            'form' => $authorform->createView(),
        ]);
    }

    /**
     * @Route("/admin/author/update/{id}", name="author_update", requirements={"id"="\d+"})
     */
    public function updateAuthor(Author $author, Request $request): Response
    {
        $authorform = $this->createForm(AuthorType::class, $author);
        $authorform->handleRequest($request);
        if ($authorform->isSubmitted() && $authorform->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($author);
            $em->flush();
            $this->addFlash('success', 'Cet.te auteur.e a été modifié.e avec succès !');
            return $this->redirectToRoute('author_index');
        }
        return $this->render('admin/author/add.html.twig', [
            'form' => $authorform->createView(),
        ]);
    }

    /**
     * @Route("/admin/author/delete/{id}", name="author_delete", requirements={"id"="\d+"})
     */
    public function delete(Author $author): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($author);
        $em->flush();
        $this->addFlash('success', 'Cet.te auteur.e a été supprimé.e !');
        return $this->redirectToRoute('author_index');
    }
}
