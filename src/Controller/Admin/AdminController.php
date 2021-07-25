<?php

namespace App\Controller\Admin;


use App\Entity\Post;
use App\Entity\Event;
use App\Form\PostType;
use App\Form\EventType;
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
