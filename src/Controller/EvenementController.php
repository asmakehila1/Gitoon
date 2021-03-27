<?php

namespace App\Controller;

use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use App\Entity\Evenement;
use App\Entity\Reservation;
use App\Form\EvenementType;
use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Snappy\Pdf;

/**
 * @Route("/evenement")
 */
class EvenementController extends AbstractController
{
    /**
     * @Route("/", name="evenement_index", methods={"GET"})
     */
    public function index(EvenementRepository $evenementRepository, \Swift_Mailer $mailer): Response
    {
        $evts = $evenementRepository->findAll();
        $entityManager = $this->getDoctrine()->getManager();

        foreach ($evts as $item) {
            if(($item->getDate_debut() >= new \DateTime() || $item->getDate_fin() >= new \DateTime()) && $item->getActif() == true){
                $item->setActif(false);


                $message = (new \Swift_Message('Hello Email'))
                    ->setFrom('safta.yahya@esprit.tn')
                    ->setTo('safta.yahya@esprit.tn')
                    ->setBody("evenement n'est plus actif")

                ;

                $mailer->send($message);

            }
            if(($item->getDate_debut() <= new \DateTime() && $item->getDate_fin() >= new \DateTime()) && $item->getActif() == false){
                $item->setActif(true);


                $message = (new \Swift_Message('Hello Email'))
                    ->setFrom('safta.yahya@esprit.tn')
                    ->setTo('safta.yahya@esprit.tn')
                    ->setBody("evenement n'est plus actif")

                ;

                $mailer->send($message);

            }


        }
        $entityManager->flush();

        return $this->render('evenement/index.html.twig', [
            'evenements' => $evenementRepository->findAll(),
        ]);
    }
    /**
     * @Route("/search/{data}", name="evenement_search", methods={"GET"})
     */
    public function search(EvenementRepository $evenementRepository, $data = ""): Response
    {
        $evenements = $evenementRepository->createQueryBuilder('c')
        ->where('c.nom  like :data')
            ->setParameter(":data",'%'.$data.'%')
            ->getQuery()
            ->getResult();
        $resp = "";
        foreach ($evenements as $item) {
            $resp.= '<tr>
                <td>'.$item->getId().'</td>
                <td>'.$item->getNom().'</td>
                <td>'.$item->getPrixEvent().'</td>
                <td>'.$item->getDescrptionEvent().'</td>
                <td>'.$item->getDate_debut()->format("Y-m-d").'</td>
                <td>'.$item->getDateFin()->format("Y-m-d").'</td>
                <td>'.($item->getActif() == true ? "En cours" : "Pas en cours").'</td>
                <td><img src ="/uploads/images/'.$item->getPhotoEvent().'"
                         alt =""  width="100" height="100"></td>
                <td>
                    <a href="/evenement/'.$item->getId().'">show</a>
                    <a href="/evenement/'.$item->getId().'/edit">edit</a>
                </td>
            </tr>';
        }
        return new Response($resp);
    }

    /**
     * @Route("/new", name="evenement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if   ($form->isSubmitted() && $form->isValid()) {
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $form->get('photo_event')->getData();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
            $entityManager = $this->getDoctrine()->getManager();
            $evenement->setPhotoEvent($fileName);
            $entityManager->persist($evenement);
            $entityManager->flush();

            return $this->redirectToRoute('evenement_index');
        }

        return $this->render('evenement/new.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="evenement_show", methods={"GET"})
     */
    public function show(Evenement $evenement): Response
    {
        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="evenement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Evenement $evenement): Response
    {
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if   ($form->isSubmitted() && $form->isValid()) {
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $form->get('photo_event')->getData();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
            $entityManager = $this->getDoctrine()->getManager();
            $evenement->setPhotoEvent($fileName);
            $entityManager->flush();

            return $this->redirectToRoute('evenement_index');
        }

        return $this->render('evenement/edit.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="evenement_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Evenement $evenement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evenement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($evenement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('evenement_index');
    }


    /**
     * @Route("/suggestions/{id}", name="evenement_suggestion", methods={"GET"})
     */
    public function suggestion(Request $request, Evenement $evenement): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $conn = $this->getDoctrine()->getConnection();
        $sql = 'select e.* from reservation inner join evenement e on reservation.evenement_id = e.id where client_id IN (select client_id from reservation where evenement_id = :id)  and e.id <> :id group by evenement_id ORDER by COUNT(*) DESC ';

        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $evenement->getId()]);
        dump($stmt->fetchAll());

        return $this->render('evenement/index.html.twig', ['evenements' => $stmt->fetchAll()]);
    }
    /**
     * @Route("/pdf/all", name="evenement_pdf", methods={"GET"})
     */
    public function pdfAction(Pdf $knpSnappyPdf)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $html = $this->renderView('evenement/pdf.html.twig', array(
            'evenements'  => $entityManager->getRepository(Evenement::class)->findAll()
        ));

        return new PdfResponse(
            $knpSnappyPdf->getOutputFromHtml($html),
            'file.pdf'
        );
    }
}
