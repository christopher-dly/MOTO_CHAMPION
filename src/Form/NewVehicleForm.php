<?php

namespace App\Form;

use App\Entity\NewVehicle;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints as Assert;
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
            ->add('NewVehicleImageForm', NewVehicleImageFormType::class)
            ->add('submit', SubmitType::class);
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => NewVehicle::class,
        ]);
    }
}