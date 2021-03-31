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
 * @Route("/temoinfront")
 */
class TemoinfrontController extends AbstractController
{
    /**
     * @Route("/", name="temoin_indexfront", methods={"GET"})
     */
    public function index(TemoinRepository $temoinRepository): Response
    {
        return $this->render('temoinfront/index.html.twig', [
            'temoins' => $temoinRepository->findAll(),
        ]);
    }



    /**
     * @Route("/{id}", name="temoin_showfront", methods={"GET"})
     */
    public function show(Temoin $temoin): Response
    {
        return $this->render('temoinfront/show.html.twig', [
            'temoin' => $temoin,
        ]);
    }


}
