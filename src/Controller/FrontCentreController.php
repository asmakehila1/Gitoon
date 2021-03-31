<?php

namespace App\Controller;
use App\Entity\CentreComment;
use App\Entity\Centre;
use App\Entity\Rating;
use App\Form\Centre1Type;
use App\Repository\CentreRepository;
use App\Repository\ReservationRepository;
use Dompdf\Dompdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/front/centre")
 */
class FrontCentreController extends AbstractController
{

    /**
     * @Route("/genrPdf", name="genrPdf", methods={"GET"})
     */
    public function genrPdf(CentreRepository $centreRepository): string
    {
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $test = $this->renderView('centre/tab.html.twig', [
            'centres' => $centreRepository->findAll(),
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
     * @Route("/Pdf", name="Pdf", methods={"GET"})
     */
    public function Pdf(CentreRepository $centreRepository , int $id): string
    {
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        $test = $this->renderView('centre/pdf.html.twig', [
            'centres' => $centreRepository->findoneBy($id),
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
     * @Route("/centres", name="centres", methods={"GET"})
     */
    public function Centres(CentreRepository $centreRepository): Response
    {
        return $this->render('default/centre/index.html.twig', [
            'centres' => $centreRepository->findAll(),
        ]);
    }
    /**
     * @Route("/mescentre", name="mescentre", methods={"GET"})
     */
    public function mescentre(CentreRepository $centreRepository): Response
    {
        return $this->render('default/centre/mescentre.html.twig', [
            'centres' => $centreRepository->findAll(),
        ]);
    }
    /**
     * @Route("/newComment", name="newComment", methods={"GET"})
     */
    public function newComment(Request $request,CentreRepository $centreRepository): Response
    {
        $centre = $centreRepository->find($request->query->get("id"));
        $user = $this->getUser();
        $contenu = $request->query->get("contenu");
        $CentreComment = new CentreComment();
        $CentreComment->setUser($user);
        $CentreComment->setContenu($contenu);
        $CentreComment->setCentre($centre);

        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->persist($CentreComment);
        $entityManager->flush();

        return $this->redirectToRoute('centre_afficher',array('id' => $centre->getId()));
    }


    /**
     * @Route("/new", name="centre_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $centre = new Centre();
        $form = $this->createForm(Centre1Type::class, $centre);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            


           
            $centre->setNomCentre($request->get('nom_centre'));
            $centre->setOwner($request->get('owner'));
            $centre->setAdresse($request->get('address'));
            $centre->setDescriptionCentre($request->get('description_centre'));
            $centre->setPrixCentre($request->get('prix_centre'));
            $fich = $request->files->get('photo_centre');
            $new_name = rand() . '.' . $fich->getClientOriginalExtension();
            $fich->move('uploads/', $new_name);
        
            $centre->setPhotoCentre($new_name);
            $centre->setUser($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($centre);
            $entityManager->flush();

            return $this->redirectToRoute('centres');
        }

        return $this->render('default/centre/new.html.twig', [
            'centre' => $centre,
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/{id}", name="centre_afficher", methods={"GET"})
     */
    public function afficherCentre(Centre $centre): Response
    {
        $deleteForm = $this->createDeleteForm($centre);
        $authCheker=$this->container->get('security.authorization_checker');
        $em=$this->getDoctrine()->getManager();
        $existe=0;
        $rat=1;
        $i=1;
        if ($authCheker->isgranted ('ROLE_USER')){
            $userid=$this->get('security.token_storage')->getToken()->getUser()->getId();
            $ratings=$em->getRepository(Rating::class)->findAll();
            foreach ($ratings as $rating) {
                if ( (($rating->getCentre()->getId()) == $centre->getId()) && (($rating->getUser()->getId()) == $userid)  ) {
                    $existe=1;
                    $rat=$rating->getRat();
                }
            }
        }
        if ($existe==0) {
            $ratings = $em->getRepository(Rating::class)->findAll();

            foreach ($ratings as $rating) {
                if($rating->getCentre()->getId()==$centre->getId()){
                    $rat=$rat+$rating->getRat();
                    $i=$i+1;
                }
            }
            $rat=$rat / $i;
            if($rat>1 && $rat<=2){
                $rat=2;
            }
            else if($rat>2 && $rat <= 3){
                $rat=3;
            }elseif ($rat>3 && $rat <= 4){
                $rat=4;
            }elseif ($rat==1)
            {
                $rat=1;
            }
            else{
                $rat=5;
            }
        }
        return $this->render('default/centre/show.html.twig', [
            'centre' => $centre,
            'rat'=>$rat,
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * @Route("/centre/{id}", name="centre_show", methods={"GET"})
     */
    public function show(Centre $centre): Response
    {
        return $this->render('default/centre/show.html.twig', [
            'centre' => $centre,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="centre_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Centre $centre): Response
    {   
        $form = $this->createForm(Centre1Type::class, $centre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $centre->setNomCentre($request->get('nom_centre'));
            $centre->setOwner($request->get('owner'));
            $centre->setAdresse($request->get('address'));
            $centre->setDescriptionCentre($request->get('description_centre'));
            $centre->setPrixCentre($request->get('prix_centre'));
            $fich = $request->files->get('photo_centre');
            $new_name = rand() . '.' . $fich->getClientOriginalExtension();
            $fich->move('uploads/', $new_name);
        
            $centre->setPhotoCentre($new_name);
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($centre);
            $entityManager->flush();
            

            return $this->redirectToRoute('centre_index');
        }

        return $this->render('default/centre/edit.html.twig', [
            'centre' => $centre,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/del/{id}", name="centre_del", methods={"DELETE"})
     */
    public function centre_del(Request $request, Centre $centre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$centre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            foreach($centre->getRatings() as $r)
            {
                $entityManager->remove($r);
            }
            $entityManager->remove($centre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('mescentre');
    }
    /**
     * @Route("/{id}", name="centre_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Centre $centre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$centre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            foreach($centre->getRatings() as $r)
            {
                $entityManager->remove($r);
            }
            $entityManager->remove($centre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('centre_index');
    }
    /**
     * Creates a form to delete a centre entity.
     *
     * @param Centre $centre The centre entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Centre $centre)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('centre_delete', array('id' => $centre->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}
