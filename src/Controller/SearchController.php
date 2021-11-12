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
     * @Route("/handleSearch/{Search}", name="handleSearch", methods={"GET","POST"})
     * @param Request $request
     * @param UserRepository $repo
     * @return ResponseAlias
     */

    public function handleSearchUser (Request $request, UserRepository $repo, string $Search): ResponseAlias
    {

          if($Search) {

           $users = $repo->findOneBy(['Nickname'=>$Search]);
        }
          return $this->renderForm('search/index.html.twig', [
           'Pseudo' => $users,
        ]);
    }


}
