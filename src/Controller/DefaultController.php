<?php

namespace App\Controller;

use App\Repository\CentreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/index", name="default")
     */
    public function index(): Response
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
    /**
     * @Route("/centre", name="centres")
     */
    public function Centre(CentreRepository $centreRepository): Response
    {
        return $this->render('default/centre/index.html.twig', [
            'controller_name' => 'CentreController',
            'centres' => $centreRepository->findAll()
        ]);
    }
    
}