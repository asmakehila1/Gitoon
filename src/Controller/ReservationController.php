<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\PubliciteRepository;
use App\Repository\ReservationRepository;
use Dompdf\Dompdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\DataUriNormalizer;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Twilio\Rest\Client as Client;

/**
 * @Route("/reservation")
 */
class ReservationController extends AbstractController
{
    /**
     * @Route("/genPdf", name="genPdf", methods={"GET"})
     */
    public function genPdf(ReservationRepository $reservationRepository): Response
    {
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $test = $this->renderView('reservation/tab.html.twig', [
            'reservations' => $reservationRepository->findAll(),
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
     * @Route("/", name="reservations", methods={"GET"})
     */
    public function mesReservations(ReservationRepository $reservationRepository): Response
    {
        return $this->render('default/reservation/index.html.twig', [
            'reservations' => $reservationRepository->findAll(),
        ]);
    }
    /**
     * @Route("/admin/reservation", name="reservation_indexA", methods={"GET"})
     */
    public function index(ReservationRepository $reservationRepository): Response
    {
        return $this->render('reservation/index.html.twig', [
            'reservations' => $reservationRepository->findAll(),
        ]);
    }
    /**
     * @Route("/reservation", name="reservation_index", methods={"GET"})
     */
    public function indexr(ReservationRepository $reservationRepository): Response
    {
        return $this->render('default/reservation/index.html.twig', [
            'reservations' => $reservationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="reservation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $result = Builder::create()
                ->writer(new PngWriter())
                ->writerOptions([])
                ->data($reservation->getId()."  ".$reservation->getCentre()."  ".$reservation->getClient()->getUsername())
                ->encoding(new Encoding('UTF-8'))
                ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
                ->size(300)
                ->margin(10)
                ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
                ->build();
            $normalizer = new DataUriNormalizer();
            $result->saveToFile(__DIR__.'/qrcode.png');
            $avatar = $normalizer->normalize(new \SplFileObject(__DIR__.'/qrcode.png'));
            $reservation->setQrcode($avatar);

            $sid = 'ACa4ced7930c2652c08dd72f4a31f9ebb0';
            $token = '1df6f1b89fe1242bf18d7449ffcd99d5';
            $client = new Client($sid, $token);

// Use the client to do fun stuff like send text messages!
            $client->messages->create(
            // the number you'd like to send the message to
                '+21652942079',
                [
                    // A Twilio phone number you purchased at twilio.com/console
                    'from' => '+16692382890',
                    // the body of the text message you'd like to send
                    'body' => 'Hey! votre reservation est bien crée'
                ]
            );
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reservation);
            $entityManager->flush();
            return $this->redirectToRoute('reservation_indexA');
        }

        return $this->render('reservation/new.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/newF", name="reservation_newF", methods={"GET","POST"})
     */
    public function newF(Request $request): Response
    {
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $result = Builder::create()
                ->writer(new PngWriter())
                ->writerOptions([])
                ->data($reservation->getCentre()."  ".$reservation->getClient()->getUsername())
                ->encoding(new Encoding('UTF-8'))
                ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
                ->size(300)
                ->margin(10)
                ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
                ->build();
            $normalizer = new DataUriNormalizer();
            $result->saveToFile(__DIR__.'/qrcode.png');
            $avatar = $normalizer->normalize(new \SplFileObject(__DIR__.'/qrcode.png'));
            $reservation->setQrcode($avatar);

            $sid = 'ACa4ced7930c2652c08dd72f4a31f9ebb0';
            $token = '1df6f1b89fe1242bf18d7449ffcd99d5';
            $client = new Client($sid, $token);

// Use the client to do fun stuff like send text messages!
             $client->messages->create(
             //the number you'd like to send the message to
                '+21652942079',
                [
                    // A Twilio phone number you purchased at twilio.com/console
                    'from' => '+16692382890',
                    // the body of the text message you'd like to send
                   'body' => 'Hey! votre reservation est bien crée'
               ]
            );
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reservation);
            $entityManager->flush();
            return $this->redirectToRoute('reservation_index');
        }

        return $this->render('default/reservation/new.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}", name="reservation_show", methods={"GET"})
     */
    public function show(Reservation $reservation): Response
    {
        return $this->render('reservation/show.html.twig', [
            'reservation' => $reservation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="reservation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Reservation $reservation): Response
    {
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reservation_index');
        }

        return $this->render('reservation/edit.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reservation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Reservation $reservation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reservation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reservation_index');
    }
    /**
     * @Route("/res/{id}", name="reservation_deleteA", methods={"DELETE"})
     */
    public function deleteA(Request $request, Reservation $reservation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reservation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reservation_indexA');
    }
    /**
     * @Route("/delF/{id}", name="reservation_deleteF", methods={"DELETE"})
     */
    public function deleteF(Request $request, Reservation $reservation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reservation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reservation_index');
    }
}
