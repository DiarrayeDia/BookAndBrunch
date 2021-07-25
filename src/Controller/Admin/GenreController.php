<?php

namespace App\Controller\Admin;

use App\Entity\Genre;
use App\Form\GenreType;
use App\Repository\GenreRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GenreController extends AbstractController
{
    /**
     * @Route("/admin/genre", name="genre_index")
     */
    public function index(GenreRepository $genreRepository): Response
    {
        return $this->render('admin/genre/index.html.twig', [
            'genres' => $genreRepository->findAll(),
            // là on ne remplit pas une variable
        ]);
    }


    /**
     * @Route("/admin/genre/add", name="genre_add")
     */
    public function addGenre(Request $request): Response
    {
        $genre = new Genre();
        $genreform = $this->createForm(GenreType::class, $genre);
        $genreform->handleRequest($request);
        if ($genreform->isSubmitted() && $genreform->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($genre);
            $em->flush();
            $this->addFlash('success', 'Ce genre a été ajouté avec succès !');
            return $this->redirectToRoute('genre_index');
        }
        return $this->render('admin/genre/add.html.twig', [
            'form' => $genreform->createView(),
        ]);
    }

    /**
     * @Route("/admin/genre/update/{id}", name="genre_update", requirements={"id"="\d+"})
     */
    public function updateGenre(Genre $genre, Request $request): Response
    {
        $genreform = $this->createForm(GenreType::class, $genre);
        $genreform->handleRequest($request);
        if ($genreform->isSubmitted() && $genreform->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($genre);
            $em->flush();
            $this->addFlash('success', 'Ce genre a été modifié avec succès !');
            return $this->redirectToRoute('genre_index');
        }
        return $this->render('admin/genre/add.html.twig', [
            'form' => $genreform->createView(),
        ]);
    }

    /**
     * @Route("/admin/genre/delete/{id}", name="genre_delete", requirements={"id"="\d+"})
     */
    public function delete(Genre $genre): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($genre);
        $em->flush();
        $this->addFlash('success', 'Ce genre a été supprimé !');
        return $this->redirectToRoute('genre_index');
    }
}
