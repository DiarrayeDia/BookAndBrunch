<?php

namespace App\Controller\Admin;


use App\Entity\Comment;
use App\Form\CommentType;
use App\Service\CommentService;
use App\Repository\CommentRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
* @Route("/admin/comment", name="admin_comment_")
* @package App\Controller\Admin
*/
class CommentController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(CommentRepository $commentRepository): Response
    {
        return $this->render('admin/comment/index.html.twig', [
            'comments' => $commentRepository->findAll()
        ]);
    }

    /**
     * @Route("/publish/{id}", name="publish", requirements={"id"="\d+"})
     */
    public function publish(Comment $comment): Response
    {
        //we check the comment status, if true we set it to False, else we set it to True
        $comment->setisPublished(($comment->getisPublished()) ? false : true);
        
        $em =$this->getDoctrine()->getManager();
        $em->persist($comment);
        $em->flush();
            return new Response('true');
        
    }

    /**
     * @Route("/delete/{id}", name="delete", requirements={"id"="\d+"})
     */
    public function delete(Comment $comment): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($comment);
        $em->flush();
        $this->addFlash('success', 'Ce commentaire a été supprimé !');
        return $this->redirectToRoute('admin_comment_index');
    }
}
