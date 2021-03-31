<?php

namespace App\Controller;

use App\Entity\Materiels;
use App\Form\MaterielsFormType;
use App\Repository\MaterielsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\File;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
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
            $materiels=$form->getData();
            $file=$materiels->getPhoto();
            $fileName=md5(uniqid()).'.'.$file->guessExtension();

            try{
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
            } catch (FileException $e) {
                //... handle exception if something happens during file upload
            }

            $entityManager = $this->getDoctrine()->getManager();
            $materiels->setPhoto($fileName);
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
    public function materiels(MaterielsRepository $materielsRepository, Request $request, PaginatorInterface $paginator )
    {
        $materiels = $this->getDoctrine()->getRepository(Materiels::class)->findAll();
        $materiels = $paginator->paginate(
            $materiels, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            5// Nombre de résultats par page
        );

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
     * @Route("/{id}/delete", name="materiel_delete", methods={"DELETE"})
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
            return $this->redirectToRoute('materiels');


        }

        return $this->render("materiels/materiels-form.html.twig", [
            "form_title" => "Editer un materiels",
            "form_materiels" => $form->createView(),
        ]);
    }


}

