<?php

namespace App\Form;

use App\Entity\VehicleMaintenanceXLarge;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehicleMaintenanceXLargeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('oilFilter', CheckboxType::class, [
                'required' => false,
            ])
            ->add('strainerCleaning', CheckboxType::class, [
                'required' => false,
            ])
            ->add('airFilter', CheckboxType::class, [
                'required' => false,
            ])
            ->add('sparkPlug', CheckboxType::class, [
                'required' => false,
            ])
            ->add('variatorBelt', CheckboxType::class, [
                'required' => false,
            ])
            ->add('transmissionBelt', CheckboxType::class, [
                'required' => false,
            ])
            ->add('pebble', CheckboxType::class, [
                'required' => false,
            ])
            ->add('engineOilChange', CheckboxType::class, [
                'required' => false,
            ])
            ->add('transmissionOilChange', CheckboxType::class, [
                'required' => false,
            ])
            ->add('clutchOilChange', CheckboxType::class, [
                'required' => false,
            ])
            ->add('price', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VehicleMaintenanceXLarge::class,
        ]);
    }
}