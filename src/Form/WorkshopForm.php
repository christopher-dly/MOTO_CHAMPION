<?php

namespace App\Form;

use App\Repository\VehicleMaintenanceRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WorkshopForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var VehicleMaintenanceRepository $vehicleRepo */
        $vehicleRepo = $options['vehicle_repository'];

        $vehicles = $vehicleRepo->findAll();

        $brands = [];
        $models = [];
        $years = [];

        foreach ($vehicles as $vehicle) {
            $brands[$vehicle->getBrand()] = $vehicle->getBrand();
            $models[$vehicle->getModel()] = $vehicle->getModel();
            $years[$vehicle->getYear()] = $vehicle->getYear();
        }

        // Tri facultatif
        ksort($brands);
        ksort($models);
        ksort($years);

        $builder
            ->add('brand', ChoiceType::class, [
                'required' => true,
                'choices' => $brands,
                'placeholder' => 'Choisir une marque',
                'attr' => ['class' => 'select2']
            ])
            ->add('model', ChoiceType::class, [
                'required' => true,
                'choices' => $models,
                'placeholder' => 'Choisir un modèle',
                'attr' => ['class' => 'select2']
            ])
            ->add('year', ChoiceType::class, [
                'required' => true,
                'choices' => $years,
                'placeholder' => 'Choisir une année',
                'attr' => ['class' => 'select2']
            ])
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'method' => 'GET',
            'csrf_protection' => false,
            'vehicle_repository' => null,
        ]);
    }
}
