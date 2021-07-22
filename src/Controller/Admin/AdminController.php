<?php

namespace App\Controller\Admin;

use App\Entity\Area;
use App\Entity\Book;
use App\Entity\Genre;
use App\Entity\Post;
use App\Entity\Event;
use App\Form\AreaType;
use App\Form\BookType;
use App\Form\PostType;
use App\Entity\Author;
use App\Form\EventType;
use App\Form\GenreType;
use App\Form\AuthorType;
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
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/book/add", name="book_add")
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
     * @Route("/area/add", name="area_add")
     */
    public function addArea(Request $request): Response
    {
        $area = new Area();
        $areaform = $this->createForm(AreaType::class, $area);
        $areaform->handleRequest($request);
        if ($areaform->isSubmitted() && $areaform->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($area);
            $em->flush();
            $this->addFlash('success', 'Votre zone a été ajoutée avec succès !');
            return $this->redirectToRoute('admin_home');
        }
        return $this->render('admin/area/add.html.twig', [
            'form' => $areaform->createView(),
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
}
