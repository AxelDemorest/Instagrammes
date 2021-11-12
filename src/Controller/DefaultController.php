<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use App\Form\PostType;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use ContainerCPYj7xP\getSearchControllerService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController{
    public function index(Request $request, PostRepository $postRepository, SessionInterface $session, UserRepository $userRepository): Response
    {
        if(!$session->has("login")) {
            return $this->redirectToRoute('user_connexion', [], Response::HTTP_SEE_OTHER);
        } else {

            $find_user = $userRepository->findOneBy(['id'=>$session->get("login")]);
            if(!$find_user) {
                return $this->redirectToRoute('user_deconnexion', [], Response::HTTP_SEE_OTHER);
            }
            $form = $this->createFormBuilder()

                ->add('Recherche', TextType::class, [
                    'label' =>false,
                    'attr' => [
                        'placeholder' => 'Recherche'
                    ]
                ])

                ->add('Ok', SubmitType::class, [
                    'label' =>false,
                    'attr' => [
                        'class' => 'btn btn-primary'
                    ]
                ])
                ->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $searched = $form->getData()['Recherche'];

                return $this->redirectToRoute('handleSearch' ,[ 'Search' => $searched ], Response::HTTP_SEE_OTHER);
            }

            return $this->render('index.html.twig', [
                'posts' => $postRepository->findAll(), 'user'=> $find_user,
                'formSearch' => $form->createView(),

            ]);
        }

    }
}
