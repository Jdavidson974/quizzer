<?php

namespace App\Controller;

use App\Entity\Quiz;
use App\Entity\ResultatQuiz;
use App\Entity\User;
use App\Repository\QuizRepository;
use App\Repository\ResultatQuizRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Routing\Annotation\Route;

class PageReponseClientController extends AbstractController
{
    public function __construct(private ResultatQuizRepository $repo)
    {
    }
    #[Route('/user/reponse-client/{id}', name: 'app_page_reponse_client')]
    public function index(Request $request, Quiz $quiz, NotifierInterface $notifier): Response
    {
        dump($_POST);
        if (isset($_POST) && !empty($_POST)) {
            $nbQuestion = $quiz->getQuestion()->count();
            $dataPost = $_POST;
            for ($i = 0; $i < $nbQuestion; $i++) {
                $entity = new ResultatQuiz;
                $entity->setQuestion($dataPost['question' . $i]);
                $entity->setReponse($dataPost['reponse' . $i + 1]);
                $entity->setQuiz($quiz);
                $entity->setUser($this->getUser());
                $this->repo->save($entity, true);
            }

            $notifier->send(new Notification('Vos reponse ont bien été envoyées', ['browser']));
            return $this->redirect('/user/all-quiz/' . $quiz->getUsers()->getId());
        }
        return $this->render('page_reponse_client/index.html.twig', [
            'controller_name' => 'PageReponseClientController',
            'quiz' => $quiz
        ]);
    }


    #[Route('/user/all-quiz/{id}', name: 'app_select_pro')]
    public function allQuizIndex(QuizRepository $quizRepository, UserRepository $userRepository, User $user,): Response
    {
        $quiz = $quizRepository->findBy(["user" => $user]);
        dump($quiz);
        return $this->render('all_quiz/index.html.twig', [
            'controller_name' => 'SelectProController',
        ]);
    }
}
