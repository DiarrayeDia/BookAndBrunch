<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Comment;
use App\Form\BookType;
use App\Form\CommentType;
use App\Repository\BookRepository;
use App\Service\CommentService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;

class BooksController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(BookRepository $bookRepository): Response
    {
        $books = $bookRepository->findAllwithAuthors();
        //dd($books);
        return $this->render('books/index.html.twig', [
            'books' => $books,
        ]);
    }

    /**
     * ---@Route("/book/{id}", name="book_view", methods={"GET"}, requirements={"id"="\d+"})
     * @Route("/book/{slug}", name="book_view", methods={"GET"})
     */
    public function book_view(BookRepository $bookRepository, Book $book, Request $request, CommentService $commentService): Response

    {
        $books = $bookRepository->findAllwithCategories();
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $commentService->persistComment($comment, $book, null);


            return $this->redirectToRoute('book_view', ['slug'=> $book->getSlug()]);
        }
        //dd($books);
        return $this->render('books/book_view.html.twig', [
            'books' => $books,
            'book' => $book,
            'form'=> $form->createView(),
        ]);
    }


    // --------------Book management in the back office --------------


    /**
     * @Route("/admin/book", name="book_index")
     */
    public function index(BookRepository $bookRepository): Response
    {
        //dd($books);
        return $this->render('admin/book/index.html.twig', [
            'books' => $bookRepository->findAllwithCategories(),
            // là on ne remplit pas une variable
        ]);
    }

    /**
     * @Route("/admin/book/add", name="book_add")
     */
    public function addBook(Request $request, SluggerInterface $slugger): Response
    {
        $book = new Book();
        $bookform = $this->createForm(BookType::class, $book);
        $bookform->handleRequest($request);
        if ($bookform->isSubmitted() && $bookform->isValid()) {

            $coverFile = $bookform->get('cover')->getData();
            if ($coverFile) {
                $originalFilename = pathinfo($coverFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $coverFile->guessExtension();

                try {
                    $coverFile->move(
                        $this->getParameter('covers_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }
                $book->setCover($newFilename);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush();
            $this->addFlash('success', 'Votre livre a été ajouté avec succès !');
            return $this->redirectToRoute('book_index');
        }
        return $this->render('admin/book/add.html.twig', [
            'form' => $bookform->createView(),
        ]);
    }

    /**
     * @Route("/admin/book/update/{id}", name="book_update", requirements={"id"="\d+"})
     */
    public function updateBook(Book $book, Request $request): Response
    {
        $bookform = $this->createForm(BookType::class, $book);
        $bookform->handleRequest($request);
        if ($bookform->isSubmitted() && $bookform->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush();
            $this->addFlash('success', 'Votre livre a été modifié avec succès !');
            return $this->redirectToRoute('book_index');
        }
        return $this->render('admin/book/add.html.twig', [
            'form' => $bookform->createView(),
        ]);
    }

    /**
     * @Route("/admin/book/delete/{id}", name="book_delete", requirements={"id"="\d+"})
     */
    public function delete(Book $book): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($book);
        $em->flush();
        $this->addFlash('success', 'Cette zone a été supprimée !');
        return $this->redirectToRoute('book_index');
    }
}
