<?php

namespace App\Controller\Admin;


use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommentController extends AbstractController
{
    /**
     * @Route("/admin/comment", name="comment_index")
     */
    public function index(CommentRepository $commentRepository): Response
    {
        return $this->render('admin/comment/index.html.twig', [
            'comments' => $commentRepository->findAll(),
            // là on ne remplit pas une variable
        ]);
    }


    /**
     * @Route("/comment/add", name="comment_add")
     */
    public function addComment(Request $request): Response
    {
        $comment = new Comment();
        $commentform = $this->createForm(CommentType::class, $comment);
        $commentform->handleRequest($request);
        if ($commentform->isSubmitted() && $commentform->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
            $this->addFlash('success', 'Votre commentaire a été ajouté avec succès !');
            return $this->redirectToRoute('book_view');
        }
        return $this->render('admin/comment/add.html.twig', [
            'form' => $commentform->createView(),
        ]);
    }

    /**
     * @Route("/admin/comment/update/{id}", name="comment_update", requirements={"id"="\d+"})
     */
    public function updateComment(Comment $comment, Request $request): Response
    {
        $commentform = $this->createForm(CommentType::class, $comment);
        $commentform->handleRequest($request);
        if ($commentform->isSubmitted() && $commentform->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
            $this->addFlash('success', 'Votre commentaire a été modifiée avec succès !');
            return $this->redirectToRoute('comment_index');
        }
        return $this->render('admin/comment/add.html.twig', [
            'form' => $commentform->createView(),
        ]);
    }

    /**
     * @Route("/admin/comment/delete/{id}", name="comment_delete", requirements={"id"="\d+"})
     */
    public function delete(Comment $comment): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($comment);
        $em->flush();
        $this->addFlash('success', 'Cette commentaire a été supprimée !');
        return $this->redirectToRoute('comment_index');
    }
}
