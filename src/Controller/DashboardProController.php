<?php

namespace App\Controller;

use App\Entity\Quiz;
use App\Entity\User;
use App\Repository\QuizRepository;
use App\Repository\ResultatQuizRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardProController extends AbstractController
{
    public function __construct(private QuizRepository $quizRepository,)
    {
    }
    #[Route('/pro/dashboard', name: 'app_dashboard_pro')]
    public function index(): Response
    {

        $quiz = $this->quizRepository->findBy(['users' => $this->getUser()]);
        return $this->render('dashboard_pro/index.html.twig', [
            'controller_name' => 'DashboardProController',
            'quiz' => $quiz,
        ]);
    }

    #[Route('/pro/show-result/{id}', name: 'app_show_result')]
    public function showResult(EntityManagerInterface $entityManager, Quiz $quiz, ResultatQuizRepository $resultatQuizRepository): Response
    {
        $resultats = $resultatQuizRepository->findBy(['quiz' => $quiz]);
        $a = $resultatQuizRepository->test();
        dump($a);
        return $this->render('result_pro/index.html.twig', [
            'controller_name' => 'DashboardProController',
            'resultats' => $resultats,
        ]);
    }
}
