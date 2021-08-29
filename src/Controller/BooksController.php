<?php

namespace App\Controller;

use DateTime;
use App\Entity\Book;
use App\Form\BookType;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Service\CommentService;
use App\Repository\BookRepository;
use App\Repository\CommentRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class BooksController extends AbstractController
{
    private $security;
    
    public function __construct(Security $security)
    {
        $this->security =$security;
    }

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
     * @Route("/book/{slug}", name="book_view")
     */
    public function book_view(BookRepository $bookRepository, Book $book, Request $request, CommentRepository $commentRepository): Response

    {
        $books = $bookRepository->findAllwithCategories();
        $comment = new Comment();
        $currentUser = $this->security->getUser();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setWrittenBy($currentUser);
            $comment->setBook($book);
            $comment->setisPublished(false);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
            $this->addFlash('success', 'Votre commentaire a bien été soumis, il sera publié après validation!');
            return $this->redirectToRoute('book_view', ['slug' => $book->getSlug()]);
        }
        // dd($comment);
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
        $this->addFlash('success', 'Ce livre a été supprimé !');
        return $this->redirectToRoute('book_index');
    }
}
