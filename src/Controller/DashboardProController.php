<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardProController extends AbstractController
{
    #[Route('/pro/dashboard', name: 'app_dashboard_pro')]
    public function index(): Response
    {

        return $this->render('dashboard_pro/index.html.twig', [
            'controller_name' => 'DashboardProController',
        ]);
    }
}
