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
        $tabForSelect = [];

        dump($users);
        $builder
            ->add('name')
            ->add('question')
            ->add('users', ChoiceType::class, [
                'choices' => $users
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Quiz::class,
        ]);
    }
}
