<?php

namespace App\Controller;

use App\Entity\CommentArticle;
use App\Entity\Blog;

use App\Form\CommentArticleType;
use App\Repository\CommentArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/comment/article")
 */
class CommentArticleController extends AbstractController
{
    /**
     * @Route("/", name="comment_article_index", methods={"GET"})
     */
    public function index(CommentArticleRepository $commentArticleRepository): Response
    {
        return $this->render('comment_article/index.html.twig', [
            'comment_articles' => $commentArticleRepository->findAll(),
        ]);
    }
  
    /**
     * @Route("/new", name="comment_article_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $commentArticle = new CommentArticle();
     
            $user = $this->getUser();
            $id = $request->request->get('id');
            $contenu = $request->request->get('comment');
            $entityManager = $this->getDoctrine()->getManager();
            $blog = $this->getDoctrine()
            ->getRepository(Blog::class)
            ->find($id);
            $commentArticle->setDate(new \DateTime('now'));
            $commentArticle->setBlogs($blog);
            $commentArticle->setContenu($contenu);
            $commentArticle->setUser($user);
            $entityManager->persist($commentArticle);
            $entityManager->flush();

            return $this->redirectToRoute('blog_showfront',['id' => $blog->getId()]
    );
                    }

    
    

    /**
     * @Route("/{id}", name="comment_article_show", methods={"GET"})
     */
    public function show(CommentArticle $commentArticle): Response
    {
        return $this->render('comment_article/show.html.twig', [
            'comment_article' => $commentArticle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="comment_article_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CommentArticle $commentArticle): Response
    {
        $form = $this->createForm(CommentArticleType::class, $commentArticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('comment_article_index');
        }

        return $this->render('comment_article/edit.html.twig', [
            'comment_article' => $commentArticle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="comment_article_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CommentArticle $commentArticle): Response
    {
        $id = $request->request->get('idb');
        $contenu = $request->request->get('comment');
        $entityManager = $this->getDoctrine()->getManager();
        $blog = $this->getDoctrine()
        ->getRepository(Blog::class)
        ->find($id);
        if ($this->isCsrfTokenValid('delete'.$commentArticle->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commentArticle);
            $entityManager->flush();
            return $this->redirectToRoute('blog_showfront',['id' => $blog->getId()]);

        }
        return $this->redirectToRoute('blog_showfront',['id' => $blog->getId()]);

    }
}
