<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use App\Form\PostType;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController{
    public function index(PostRepository $postRepository, SessionInterface $session, UserRepository $userRepository): Response
    {
        if(!$session->has("login")) {
            return $this->redirectToRoute('user_connexion', [], Response::HTTP_SEE_OTHER);
        } else {

            $find_user = $userRepository->findOneBy(['id'=>$session->get("login")]);
            if(!$find_user) {
                return $this->redirectToRoute('user_deconnexion', [], Response::HTTP_SEE_OTHER);
            }
            return $this->render('index.html.twig', [
                'posts' => $postRepository->findAll(), 'user'=> $find_user
            ]);
        }

    }
}
