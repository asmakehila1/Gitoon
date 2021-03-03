<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StoriesController extends AbstractController
{
    /**
     * @Route("/stories", name="stories")
     */
    public function index(): Response
    {
        return $this->render('stories/index.html.twig', [
            'controller_name' => 'StoriesController',
        ]);
    }
}
