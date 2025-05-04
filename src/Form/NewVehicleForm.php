<?php

namespace App\Form;

use App\Entity\NewVehicle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewVehicleForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('Information', InformationForm::class)
            ->add('Engine', EngineForm::class)
            ->add('Transmission', TransmissionForm::class)
            ->add('Dimension', DimensionForm::class)
            ->add('CyclePart', CyclePartForm::class)
            ->add('newVehicleImages', CollectionType::class, [
                'entry_type' => NewVehicleImageForm::class, // Le formulaire pour gérer chaque image
                'allow_add' => true, // Permet d'ajouter des images
                'allow_delete' => true, // Permet de supprimer des images
                'by_reference' => false, // Assure que les entités sont bien liées
                'prototype' => true, // Crée une version prototype de l'image
                'label' => false,
            ])
            ->add('submit', SubmitType::class);
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => NewVehicle::class,
        ]);
    }
}