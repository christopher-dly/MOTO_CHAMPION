<?php

namespace App\Form;

use App\Entity\TemporaryMessage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TemporaryMessageForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('message', TypeTextType::class, [
                'constraints' => [
                    new \Symfony\Component\Validator\Constraints\Length([
                        'min' => 1,
                        'max' => 100,
                        'maxMessage' => 'Votre message doit faire au maximum {{ limit }} caractères',
                    ]),
                ],
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TemporaryMessage::class,
        ]);
    }
}