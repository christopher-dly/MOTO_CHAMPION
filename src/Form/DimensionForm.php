<?php

namespace App\Form;

use App\Entity\Dimension;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DimensionForm extends AbstractType
{
    public function buildForm (FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('length', NumberType::class , [
                'required' => false,
            ])
            ->add('width', NumberType::class , [
                'required' => false,
            ])
            ->add('height', NumberType::class , [
                'required' => false,
            ])
            ->add('saddleHeight', NumberType::class , [
                'required' => false,
            ])
            ->add('groundClearance', NumberType::class , [
                'required' => false,
            ])
            ->add('gas', TextType::class , [
                'required' => false,
            ])
            ->add('oil', TextType::class , [
                'required' => false,
            ])
            ->add('weight', NumberType::class , [
                'required' => false,
            ]);
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dimension::class,
        ]);
    }
}