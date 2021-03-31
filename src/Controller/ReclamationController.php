<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Entity\Reservation;
use App\Form\reclamation1Type;
use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
use Dompdf\Dompdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/reclamation")
 */
class ReclamationController extends AbstractController
{


    /**
     * @Route("/genrPdf", name="genrPdf", methods={"GET"})
     */
    public function genrPdf(ReclamationRepository $reclamationRepository): string
    {
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $test = $this->renderView('reclamation/tab.html.twig', [
            'reclamations' => $reclamationRepository->findAll(),
        ]);
        $dompdf->loadHtml($test);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
        return  $test;


    }



    /**
     * @Route("/index", name="reclamations", methods={"GET"})
     */
    public function mesReclamation(ReclamationRepository $reclamationRepository): Response
    {
        $em = $this->getDoctrine()->getManager();
        $reclamations = $em->getRepository(Reclamation::class)
            ->findBy(array('Client' => $this->getUser()->getId() ));
        return $this->render('default/reclamation/index.html.twig', [
            'reclamations' => $reclamations,
        ]);
    }
    /**
     * @Route("/", name="reclamation_index", methods={"GET"})
     */
    public function index(ReclamationRepository $reclamationRepository): Response
    {
        return $this->render('reclamation/index.html.twig', [
            'reclamations' => $reclamationRepository->findAll(),
        ]);
    }


    /**
     * @Route("/newreclamation", name="reclamation_nouveau", methods={"GET","POST"})
     */
    public function nouveauReclamation(Request $request): Response
    {
      //  dd('1');

        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $reclamation->setTypeReclamation($form->get('type_reclamation')->getData());
            $reclamation->setObjetReclamation($form->get('objet_reclamation')->getData());
            $reclamation->setDescriptionReclamation($form->get('description_reclamation')->getData());
            $fich = $form->get('image_reclamation')->getData();
            $new_name = rand() . '.' . $fich->getClientOriginalExtension();
            $fich->move('uploads/', $new_name);

            $reclamation->setImageReclamation($new_name);
            $reclamation->setClient($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($reclamation);
            $entityManager->flush();
            return $this->redirectToRoute('reclamation_afficher',array('id' => $reclamation->getId()));
        }

        return $this->render('default/reclamation/new.html.twig', [
                'form' => $form->createView(),
                'reclamation' => $reclamation,
            ]
            );
    }
    /**
     * @Route("/new", name="reclamation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reclamation);
            $entityManager->flush();

            return $this->redirectToRoute('reclamation_index');
        }

        return $this->render('reclamation/new.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reclamation_afficher", methods={"GET"})
     */
    public function afficher(Reclamation $reclamation): Response
    {
        return $this->render('default/reclamation/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }

    /**
     * @Route("/{id}", name="reclamation_show", methods={"GET"})
     */
    public function show(Reclamation $reclamation): Response
    {
        return $this->render('reclamation/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="reclamation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Reclamation $reclamation): Response
    {
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reclamation_index');
        }

        return $this->render('reclamation/edit.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reclamation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Reclamation $reclamation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reclamation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reclamation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reclamation_index');
    }
}
