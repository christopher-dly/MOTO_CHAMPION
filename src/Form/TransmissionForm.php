<?php

namespace App\Form;

use App\Entity\Transmission;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransmissionForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('finalTransmission', TextType::class , [
                'required' => false,
            ])
            ->add('clutch', TextType::class , [
                'required' => false,
            ])
            ->add('command', TextType::class , [
                'required' => false,
            ])
            ->add('gearbox', TextType::class , [
                'required' => false,
            ]);
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Transmission::class,
        ]);
    }
}