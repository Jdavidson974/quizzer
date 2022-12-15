<?php

namespace App\Controller;

use App\Entity\Quiz;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageReponseClientController extends AbstractController
{
    #[Route('/page/reponse-client/{id}', name: 'app_page_reponse_client')]
    public function index(Quiz $quiz): Response
    {
        return $this->render('page_reponse_client/index.html.twig', [
            'controller_name' => 'PageReponseClientController',
            'quiz' => $quiz
        ]);
    }
}
