<?php

namespace App\Form;

use App\Entity\UsedVehicle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditUsedVehicleForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('brand', TextType::class)
            ->add('model', TextType::class)
            ->add('category', ChoiceType::class, [
                'choices' => [
                    'Trail' => 'Trail',
                    'Sport / GT' => 'Sport / GT',
                    'Roadster' => 'Roadster',
                    'Tout-terrain' => 'Tout-terrain',
                    'Supermoto' => 'Supermoto',
                    'Scooter' => 'Scooter',
                    'Moto 125' => 'Moto 125',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('cylinders', NumberType::class)
            ->add('price', TextType::class)
            ->add('warrantyTime', NumberType::class)
            ->add('description', TextType::class)
            ->add('availableForTrial', CheckboxType::class, [
                'required' => false,
            ])
            ->add('color', TextType::class)
            ->add('year', NumberType::class)
            ->add('kilometers', NumberType::class)
            ->add('energyTax', NumberType::class)
            ->add('taxPower', TextType::class)
            ->add('power', TextType::class)
            ->add('statue', CheckboxType::class, [
                'required' => false,
            ])
            ->add('a2', CheckboxType::class, [
                'required' => false,
            ])
            ->add('submit', SubmitType::class);
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UsedVehicle::class,
        ]);
    }
}