<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SelectProController extends AbstractController
{
    #[Route('/user/select/pro', name: 'app_select_pro')]
    public function index(UserRepository $userRepository): Response
    {
        $pro = $userRepository->findBy(['role' => 2]);
        return $this->render('select_pro/index.html.twig', [
            'controller_name' => 'SelectProController',
            'pro' => $pro,
        ]);
    }
}
