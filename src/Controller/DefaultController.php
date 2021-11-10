<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController{
    public function index(PostRepository $postRepository, SessionInterface $session): Response
    {
        if(!$session->has("login")) {
            return $this->redirectToRoute('user_connexion', [], Response::HTTP_SEE_OTHER);
        } else {
            return $this->render('index.html.twig', [
                'posts' => $postRepository->findAll(),
            ]);
        }

    }
}
