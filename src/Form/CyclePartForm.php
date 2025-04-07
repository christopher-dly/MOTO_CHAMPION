<?php

namespace App\Form;

use App\Entity\CyclePart;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class CyclePartForm extends AbstractType
{
    public function buildForm (FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('casterAngle', TextType::class)
            ->add('caster', TextType::class)
            ->add('wheelbase', TextType::class)
            ->add('rim', TextType::class)
            ->add('frame', TextType::class)
            ->add('frontSuspension', TextType::class)
            ->add('rearSuspension', TextType::class)
            ->add('frontBrake', TextType::class)
            ->add('rearBrake', TextType::class)
            ->add('frontWheel', TextType::class)
            ->add('rearWheel', TextType::class);
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CyclePart::class,
        ]);
    }
}