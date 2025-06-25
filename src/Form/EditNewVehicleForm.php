<?php

namespace App\Form;

use App\Entity\NewVehicle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditNewVehicleForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TypeTextType::class)
            ->add('commercialOperation', TypeTextType::class, [
                'required' => false,
            ])
            ->add('Information', InformationForm::class)
            ->add('Engine', EngineForm::class)
            ->add('Transmission', TransmissionForm::class)
            ->add('Dimension', DimensionForm::class)
            ->add('CyclePart', CyclePartForm::class)
            ->add('submit', SubmitType::class);
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => NewVehicle::class,
        ]);
    }
}