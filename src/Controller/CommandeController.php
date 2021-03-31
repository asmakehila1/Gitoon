<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Commande;
use App\Entity\Materiels;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Dompdf\Dompdf;
use Dompdf\Options;

class CommandeController extends AbstractController
{
    /**
     * @Route("/commande", name="commande")
     */
    public function index(): Response
    {
        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
        ]);
    }
    /**
     * @Route("/{id}/add", name="add_commande", methods={"GET","POST"})
     */
    public function addCommande(Request $request, Materiels $materiels): Response
    {
        $materiels->setQuantite($materiels->getQuantite() - 1);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($materiels);
        $commnde = new Commande();
        $commnde->setDuree($materiels->getDureeLocation());
        $commnde->setNom($materiels->getNom());
        $commnde->setPrix($materiels->getPrix());
        $commnde->setPhoto($materiels->getPhoto());
        /* @var \App\Entity\Client $client */
        $client = $this->getDoctrine()->getRepository(Client::class)->find(1);
        $commnde->setClient($client);
        $client->addCommandes($commnde);
        $entityManager->persist($commnde);
        $entityManager->persist($client);
        $entityManager->flush();
        return $this->redirectToRoute('commandes');
    }
    /**
     * @Route("/commandes", name="commandes")
     */
    public function materiels()
    {
        $commandes = $this->getDoctrine()->getRepository(Commande::class)->findBy(array('Client' => 1));
        return $this->render('commande/index.html.twig', [
            "commandes" => $commandes,
        ]);
    }
    /**
     * @Route("/{id}/delete", name="commande_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Commande $commande): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commande->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commande);
            $entityManager->flush();
        }

        return $this->redirectToRoute('commandes');
    }
    /**
     * @Route("/pdf", name="pdf")
     */
    public function generateAndDownload( \Swift_Mailer $mailer)
    {
        $client = $this->getDoctrine()->getRepository(Client::class)->find(1);

        $message = (new \Swift_Message('Validation Commande'))

            ->setFrom('appgitoon39@gmail.com')
            ->setTo($client->getMail())

            // Give it a body
            ->setBody('salut Mr/Mme ' . $client->getPrenom() .  $client->getNom() . 'votre bande de commande a été telechargé avec succees veuiller apporter avec vous pour prendred la materiel necessaires', 'text/html');
        $mailer->send($message);
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $commandes = $this->getDoctrine()->getRepository(Commande::class)->findBy(array('Client' => 1));
        $user = $this->getDoctrine()->getRepository(Client::class)->find(1);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('commande/mypdf.html.twig', [
            'commandes' => $commandes,
            'user' => $user
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);
    }
}
