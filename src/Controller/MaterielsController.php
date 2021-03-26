<?php

namespace App\Controller;

use App\Entity\Materiels;
use App\Form\MaterielsFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class
MaterielsController extends AbstractController
{
    /**
     * @Route("/materiels", name="materiels")
     */
    public function index(): Response
    {
        return $this->render('materiels/index.html.twig', [
            'controller_name' => 'MaterielsController',
        ]);
    }
    /**
     * @Route("/add_materiel", name="add_materiel")
     */
    public function addMateriel(Request $request): Response
    {
        $materiels = new Materiels();
        $form = $this->createForm(MaterielsFormType::class, $materiels);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($materiels);
            $entityManager->flush();
            return $this->redirectToRoute('showAdmin');


        }

        return $this->render("materiels/materiels-form.html.twig", [
            "form_title" => "Ajouter un materiels",
            "form_materiels" => $form->createView(),
        ]);
    }

    /**
     * @Route("/materiels", name="materiels")
     */
    public function materiels()
    {
        $materiels = $this->getDoctrine()->getRepository(Materiels::class)->findAll();

        return $this->render('materiels/materiels.html.twig', [
            "materiels" => $materiels,
        ]);
    }
    /**
     * @Route("/showAdmin", name="showAdmin")
     */
    public function show()
    {
        $materiels = $this->getDoctrine()->getRepository(Materiels::class)->findAll();

        return $this->render('materiels/index.html.twig', [
            "materiels" => $materiels,
        ]);
    }
    /**
     * @Route("/{id}", name="materiel_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Materiels $materiels): Response
    {
        if ($this->isCsrfTokenValid('delete'.$materiels->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($materiels);
            $entityManager->flush();
        }

        return $this->redirectToRoute('showAdmin');
    }
    /**
     * @Route("/{id}/edit", name="materiel_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Materiels $materiels): Response
    {
        $form = $this->createForm(MaterielsFormType::class, $materiels);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($materiels);
            $entityManager->flush();
            return $this->redirectToRoute('showAdmin');


        }

        return $this->render("materiels/materiels-form.html.twig", [
            "form_title" => "Editer un materiels",
            "form_materiels" => $form->createView(),
        ]);
    }
}

