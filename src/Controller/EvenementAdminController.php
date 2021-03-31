<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\evenement1Type;
use App\Form\EvenementType;
use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/evenement")
 */
class EvenementAdminController extends AbstractController
{
    /**
     * @Route("/eve/", name="evenementsA", methods={"GET"})
     */
    public function evenement(EvenementRepository $evenementRepository): Response
    {
        return $this->render('evenement/index.html.twig', [
            'evenements' => $evenementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/nouveau", name="evenement_nouveauA", methods={"GET","POST"})
     */
    public function nouveau(Request $request): Response
    {
        $evenement = new evenement();
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {


            $evenement->setPrixEvent($form->get('prix_event')->getData());
            $evenement->setDescrptionEvent($form->get('descrption_event')->getData());
            $fich = $form->get('photo_event')->getData();
            $new_name = rand() . '.' . $fich->getClientOriginalExtension();
            $fich->move('uploads/', $new_name);

            $evenement->setPhotoEvent($new_name);
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($evenement);
            $entityManager->flush();

            return $this->redirectToRoute('evenementsA');
        }

        return $this->render('evenement/new.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/evenement/{id}", name="evenement_afficherA", methods={"GET"})
     */
    public function afficher(Evenement $evenement): Response
    {
        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
        ]);
    }

    /**
     * @Route("/edit/{id}/edit", name="evenement_modifierA", methods={"GET","POST"})
     */
    public function modifier(Request $request, Evenement $evenement): Response
    {

        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $evenement->setPrixEvent($form->get('prix_event')->getData());
            $evenement->setDescrptionEvent($form->get('descrption_event')->getData());
            $fich = $form->get('photo_event')->getData();
            $new_name = rand() . '.' . $fich->getClientOriginalExtension();
            $fich->move('uploads/', $new_name);

            $evenement->setPhotoEvent($new_name);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('evenement_indexA');
        }

        return $this->render('evenement/edit.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/del/{id}", name="evenement_supprimerA", methods={"POST"})
     */
    public function supprimer(Request $request, Evenement $evenement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evenement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($evenement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('evenementsA');
    }

    /**
     * @Route("/", name="evenement_indexA", methods={"GET"})
     */
    public function index(EvenementRepository $evenementRepository): Response
    {
        return $this->render('evenement/index.html.twig', [
            'evenements' => $evenementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="evenement_newA", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $evenement = new evenement();
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {


            $evenement->setPrixEvent($form->get('prix_event')->getData());
            $evenement->setDescrptionEvent($form->get('descrption_event')->getData());
            $fich = $form->get('photo_event')->getData();
            $new_name = rand() . '.' . $fich->getClientOriginalExtension();
            $fich->move('uploads/', $new_name);

            $evenement->setPhotoEvent($new_name);
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($evenement);
            $entityManager->flush();

            return $this->redirectToRoute('evenementsA');

        }

        return $this->render('evenement/new.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/show/{id}", name="evenement_showA", methods={"GET"})
     */
    public function show(Evenement $evenement): Response
    {
        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="evenement_editA", methods={"GET","POST"})
     */
    public function edit(Request $request, Evenement $evenement): Response
    {
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('evenement_indexA');
        }

        return $this->render('evenement/edit.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="evenement_deleteA", methods={"POST"})
     */
    public function delete(Request $request, Evenement $evenement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evenement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($evenement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('evenement_indexA');
    }

}
