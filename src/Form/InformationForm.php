<?php

namespace App\Form;

use App\Entity\Information;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class InformationForm extends AbstractType
{
    public function buildForm (FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('brand', ChoiceType::class, [
                'choices' => [
                    'Suzuki' => 'Suzuki',
                    'Kymco' => 'Kymco',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('model', TextType::class)
            ->add('category', ChoiceType::class, [
                'choices' => [
                    'Trail' => 'Trail',
                    'Sport / GT' => 'Sport / GT',
                    'Roadster' => 'Roadster',
                    'Scooter' => 'Scooter',
                    'Moto 125' => 'Moto 125',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('cylinders', TextType::class)
            ->add('price', TextType::class)
            ->add('warrantyTime', TextType::class)
            ->add('availableForTrial', CheckboxType::class, [
                'required' => false,
            ])
            ->add('a2', CheckboxType::class, [
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Information::class,
        ]);
    }
}