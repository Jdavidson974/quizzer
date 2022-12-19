<?php

namespace App\Controller;

use App\Repository\QuizRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class ApiController extends AbstractController
{
    #[Route('/api/quiz', name: 'app_api_uiz')]
    public function index(QuizRepository $quizRepository, SerializerInterface $serializer): JsonResponse
    {

        $json = $serializer->serialize(
            $quizRepository->findAll(),
            JsonEncoder::FORMAT,
            [AbstractNormalizer::GROUPS => 'quiz']
        );
        return new JsonResponse($json);
        // foreach ($data as $key => $value) {
        //     $json[$key]['id'] = $value->getId();
        //     $json[$key]['theme'] = $value->getName();
        //     foreach ($value->getQuestion() as $keyQ => $valueQ) {
        //         $json[$key]['questions'][$keyQ] = $valueQ->getName();
        //         foreach ($valueQ->getReponse() as $keyR => $valueR) {
        //             // $json[$key]['question'][$keyQ] = $valueR->getReponse();
        //         }
        //     }
        // }
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
        // return new JsonResponse($json);
    }
}
