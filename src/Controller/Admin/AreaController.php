<?php

namespace App\Controller\Admin;

use App\Entity\Area;
use App\Form\AreaType;
use App\Repository\AreaRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AreaController extends AbstractController
{
    /**
     * @Route("/admin/area", name="area_index")
     */
    public function index(AreaRepository $areaRepository): Response
    {
        return $this->render('admin/area/index.html.twig', [
            'areas' => $areaRepository->findAll(),
            // là on ne remplit pas une variable
        ]);
    }


    /**
     * @Route("/admin/area/add", name="area_add")
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
            return $this->redirectToRoute('area_index');
        }
        return $this->render('admin/area/add.html.twig', [
            'form' => $areaform->createView(),
        ]);
    }

    /**
     * @Route("/admin/area/update/{id}", name="area_update", requirements={"id"="\d+"})
     */
    public function updateArea(Area $area, Request $request): Response
    {
        $areaform = $this->createForm(AreaType::class, $area);
        $areaform->handleRequest($request);
        if ($areaform->isSubmitted() && $areaform->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($area);
            $em->flush();
            $this->addFlash('success', 'Votre zone a été modifiée avec succès !');
            return $this->redirectToRoute('area_index');
        }
        return $this->render('admin/area/add.html.twig', [
            'form' => $areaform->createView(),
        ]);
    }

    /**
     * @Route("/admin/area/delete/{id}", name="area_delete", requirements={"id"="\d+"})
     */
    public function delete(Area $area): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($area);
        $em->flush();
        $this->addFlash('success', 'Cette zone a été supprimée !');
        return $this->redirectToRoute('area_index');
    }
}
