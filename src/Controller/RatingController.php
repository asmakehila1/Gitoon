<?php

namespace App\Controller;

use App\Entity\Centre;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Rating;
use Symfony\Component\Routing\Annotation\Method;


class RatingController extends AbstractController
{
    /**
     * @Route("/rating", name="centre_rating", methods={"GET"})
     */
    public function ratingAction(Request $request) : Response
    {
        $em=$this->getDoctrine()->getManager();

        $rat =$request->get('rat');
        $idcentre =$request->get('id');
        $iduser=$this->get('security.token_storage')->getToken()->getUser()->getId();
        $centre=$em->getRepository(Centre::class)->find($idcentre);
        $ratings=$em->getRepository(Rating::class)->findAll();
        $existe=0;
        foreach ($ratings as $rating) {
            if ( ($rating->getCentre()->getId() == $idcentre) && (($rating->getUser())->getId() == $iduser)  ) {
                $rating->setRat($rat);
                $em->persist($rating);
                $em->flush();
                $existe=1;
            }
        }
        if ($existe==0){
            $rating=new Rating();
            $rating->setRat($rat);
            $rating->setUser($this->get('security.token_storage')->getToken()->getUser());
            $rating->setCentre($centre);
            $em->persist($rating);
            $em->flush();
        }
        $ratt=$em->getRepository(Rating::class)->getAVGrating($idcentre);
        return $this->render('default/centre/show.html.twig' , [
            'centre' => $centre,
            'rat' => $ratt
        ]);
        // return $this->render('@Produit/Default/clientViews/index.html.twig', array('existe' => $existe));




    }
}
