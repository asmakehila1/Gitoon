<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserBackController extends AbstractController
    /**
     * @Route("/user_back")
     */
{
    /**
     * @Route("/", name="user_index_back", methods={"GET"})
     */
    public function index(UserRepository $userRepository,Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);
        return $this->render('user_back/index.html.twig', [
            'users' => $userRepository->findAll(),
            'form' => $form->CreateView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete_admin", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index_back');
    }
}
