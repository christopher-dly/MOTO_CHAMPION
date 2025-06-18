<?php

namespace App\Form;

use App\Entity\Engine;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EngineForm extends AbstractType
{
    public function buildForm (FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', TextType::class, [
                'required' => false,
            ])
            ->add('cylinders', TextType::class, [
                'required' => false,
            ])
            ->add('announcedPower', TextType::class, [
                'required' => false,
            ])
            ->add('coupleAnnounced', TextType::class, [
                'required' => false,
            ])
            ->add('powerSupply', TextType::class, [
                'required' => false,
            ])
            ->add('consumption', TextType::class, [
                'required' => false,
            ])
            ->add('co2Emissions', TextType::class, [
                'required' => false,
            ]);
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Engine::class,
        ]);
    }
}