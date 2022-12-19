<?php

namespace App\Form;

use App\Entity\Quiz;
use App\Repository\QuizRepository;
use App\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuizType extends AbstractType
{
    public function __construct(private UserRepository $userRepository)
    {
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $users = $this->userRepository->findUsers('ROLE_PRO');
        $array = [];
        foreach ($users as $key => $value) {
            array_push($array, [$value->getEmail() =>  $value->getId()]);
        }
        dump($array);
        $builder
            ->add('name')
            ->add('question')
            ->add('users', ChoiceType::class, [
                'choices' => $array,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Quiz::class,
        ]);
    }
}
