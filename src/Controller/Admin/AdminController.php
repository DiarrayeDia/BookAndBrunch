<?php

namespace App\Controller\Admin;

use App\Entity\Area;
use App\Entity\Book;
use App\Entity\Post;
use App\Entity\Event;
use App\Entity\Genre;
use App\Entity\Author;
use App\Form\AreaType;
use App\Form\BookType;
use App\Form\PostType;
use App\Form\EventType;
use App\Form\GenreType;
use App\Form\AuthorType;
use App\Entity\Bookshelf;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_index")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
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
     * @Route("/genre/add", name="genre_add")
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
            $this->addFlash('success', 'Votre genre a été ajouté avec succès !');
            return $this->redirectToRoute('admin_home');
        }
        return $this->render('admin/genre/add.html.twig', [
            'form' => $genreform->createView(),
        ]);
    }

    /**
     * @Route("/post/add", name="post_add")
     */
    public function addPost(Request $request): Response
    {
        $post = new Post();
        $postform = $this->createForm(PostType::class, $post);
        $postform->handleRequest($request);
        if ($postform->isSubmitted() && $postform->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            $this->addFlash('success', 'Votre post a été ajouté avec succès !');
            return $this->redirectToRoute('admin_home');
        }
        return $this->render('admin/post/add.html.twig', [
            'form' => $postform->createView(),
        ]);
    }

    /**
     * @Route("/event/add", name="event_add")
     */
    public function addEvent(Request $request): Response
    {
        $event = new Event();
        $eventform = $this->createForm(EventType::class, $event);
        $eventform->handleRequest($request);
        if ($eventform->isSubmitted() && $eventform->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();
            $this->addFlash('success', 'Votre événement a été ajouté avec succès !');
            return $this->redirectToRoute('admin_home');
        }
        return $this->render('admin/event/add.html.twig', [
            'form' => $eventform->createView(),
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
