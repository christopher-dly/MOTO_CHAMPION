<?php

namespace App\Form;

use App\Entity\Dimension;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class DimensionForm extends AbstractType
{
    public function buildForm (FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('length', TextType::class)
            ->add('width', TextType::class)
            ->add('height', TextType::class)
            ->add('saddleHeight', TextType::class)
            ->add('groundClearance', TextType::class)
            ->add('gas', TextType::class)
            ->add('oil', TextType::class)
            ->add('weight', TextType::class);
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dimension::class,
        ]);
    }
}