<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrgController extends AbstractController
{
    /**
     * @Route("/org", name="org")
     */
    public function index(): Response
    {
        return $this->render('org/index.html.twig', [
            'controller_name' => 'OrgController',
        ]);
    }

      /**
      * @Route("/org/save")
      */
      public function save() {
        $entityManager = $this->getDoctrine()->getManager();
 
        $org = new org();
        $org->setOrgId('Article 3');
        $org->setPrix(3000);
       
        $entityManager->persist($article);
        $entityManager->flush();
 
        return new Response('Article enregisté avec id   '.$article->getId());
      }


}
