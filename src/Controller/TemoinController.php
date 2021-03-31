<?php

namespace App\Controller;

use App\Entity\Temoin;
use App\Form\TemoinType;
use App\Repository\TemoinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/temoin")
 */
class TemoinController extends AbstractController
{
    /**
     * @Route("/", name="temoin_index", methods={"GET"})
     */
    public function index(TemoinRepository $temoinRepository): Response
    {
        return $this->render('temoin/index.html.twig', [
            'temoins' => $temoinRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="temoin_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $temoin = new Temoin();
        $form = $this->createForm(TemoinType::class, $temoin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($temoin);
            $entityManager->flush();

            return $this->redirectToRoute('temoin_index');
        }

        return $this->render('temoin/new.html.twig', [
            'temoin' => $temoin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="temoin_show", methods={"GET"})
     */
    public function show(Temoin $temoin): Response
    {
        return $this->render('temoin/show.html.twig', [
            'temoin' => $temoin,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="temoin_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Temoin $temoin): Response
    {
        $form = $this->createForm(TemoinType::class, $temoin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('temoin_index');
        }

        return $this->render('temoin/edit.html.twig', [
            'temoin' => $temoin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="temoin_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Temoin $temoin): Response
    {
        if ($this->isCsrfTokenValid('delete'.$temoin->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($temoin);
            $entityManager->flush();
        }

        return $this->redirectToRoute('temoin_index');
    }
}
