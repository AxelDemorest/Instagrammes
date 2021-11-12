<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
#use Composer\DependencyResolver\Request;
#use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function index(): ResponseAlias
    {
        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
        ]);
    }

    public function searchBar(): ResponseAlias
    {
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
        return $this->render('search/searchBar.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/handleSearch", name="handleSearch", methods={"GET","POST"})
     * @param Request $request
     * @param UserRepository $repo
     * @return ResponseAlias
     */

    public function handleSearchUser (Request $request, UserRepository $repo): ResponseAlias
    {
        $query = $request->request->get('form')['Recherche'];

          if($query) {
           $users = $repo->findOneBy($query);
        }
          return $this->render('search/index.html.twig', [
           'Pseudo' => $users
        ]);
    }


}
