<?php

namespace App\Controller;

use App\Entity\Publicite;
use App\Form\PubliciteType;
use App\Repository\PubliciteRepository;
use Dompdf\Dompdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/publicite")
 */
class PubliciteController extends AbstractController
{
    /**
     * @Route("/generatePdf", name="generatePdf", methods={"GET"})
     */
    public function generatePdf(PubliciteRepository $publiciteRepository): Response
    {
            // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $test = $this->renderView('publicite/table.html.twig', [
            'publicites' => $publiciteRepository->findAll(),
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
     * @Route("/", name="publicite_index", methods={"GET"})
     */
    public function index(PubliciteRepository $publiciteRepository): Response
    {
        return $this->render('publicite/index.html.twig', [
            'publicites' => $publiciteRepository->findAll(),
        ]);
    }


    /**
     * @Route("/new", name="publicite_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $publicite = new Publicite();
        $form = $this->createForm(PubliciteType::class, $publicite);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $publicite->setTitrePub($request->get('titre_pub'));
            $publicite->setDescriptionPub($request->get('description_pub'));
            $fich = $request->files->get('image_pub');
            $new_name = rand() . '.' . $fich->getClientOriginalExtension();
            $fich->move('uploads/', $new_name);

            $publicite->setImagePub($new_name);
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($publicite);
            $entityManager->flush();

            return $this->redirectToRoute('publicite_index');
        }

        return $this->render('publicite/new.html.twig', [
            'publicite' => $publicite,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/{id}", name="publicite_show", methods={"GET"})
     */
    public function show(Publicite $publicite): Response
    {
        return $this->render('publicite/show.html.twig', [
            'publicite' => $publicite,
        ]);
    }

















    /**
     * @Route("/{id}/edit", name="publicite_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Publicite $publicite): Response
    {
        $form = $this->createForm(PubliciteType::class, $publicite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $publicite->setTitrePub($request->get('titre_pub'));
            $publicite->setDescriptionPub($request->get('description_pub'));

            //$fich = $request->files->get('image_pub');
            //$new_name = rand() . '.' . $fich->getClientOriginalExtension();
            //$fich->move('uploads/', $new_name);

            //$publicite->setImagePub($new_name);

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($publicite);
            $entityManager->flush();

            return $this->redirectToRoute('publicite_index');
        }

        return $this->render('publicite/edit.html.twig', [
            'publicite' => $publicite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="publicite_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Publicite $publicite): Response
    {
        if ($this->isCsrfTokenValid('delete'.$publicite->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($publicite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('publicite_index');
    }
}
