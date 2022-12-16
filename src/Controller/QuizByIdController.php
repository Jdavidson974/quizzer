<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\QuizRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuizByIdController extends AbstractController
{

    #[Route('/user/all-quiz/{id}', name: 'app_quiz_by_id')]
    public function index(QuizRepository $quizRepository, UserRepository $userRepository, User $user,): Response
    {
        $quiz = $quizRepository->findBy(["users" => $user]);
        return $this->render('all_quiz/index.html.twig', [
            'controller_name' => 'SelectProController',
            'quiz' => $quiz,
            'user' => $user,
        ]);
    }
}
