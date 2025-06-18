<?php

namespace App\Form;

use App\Entity\CyclePart;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CyclePartForm extends AbstractType
{
    public function buildForm (FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('casterAngle', TextType::class, [
                'required' => false,
            ])
            ->add('caster', TextType::class, [
                'required' => false,
            ])
            ->add('wheelbase', TextType::class,[
                'required' => false,
            ])
            ->add('rim', TextType::class, [
                'required' => false,
            ])
            ->add('frame', TextType::class, [
                'required' => false,
            ])
            ->add('frontSuspension', TextType::class ,[
                'required' => false,
            ])
            ->add('rearSuspension', TextType::class ,[
                'required' => false,
            ])
            ->add('frontBrake', TextType::class ,[
                'required' => false,
            ])
            ->add('rearBrake', TextType::class ,[
                'required' => false,
            ])
            ->add('frontWheel', TextType::class , [
                'required' => false,
            ])
            ->add('rearWheel', TextType::class , [
                'required' => false,
            ]);
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CyclePart::class,
        ]);
    }
}