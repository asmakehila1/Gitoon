<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrgEventController extends AbstractController
{
    /**
     * @Route("/org/event", name="org_event")
     */
    public function index(): Response
    {
        return $this->render('org_event/index.html.twig', [
            'controller_name' => 'OrgEventController',
        ]);
    }
}
