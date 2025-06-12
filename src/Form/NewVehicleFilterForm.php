<?php

namespace App\Form;

use App\Repository\InformationRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class NewVehicleFilterForm extends AbstractType
{   
    private $vehicleRepository;

    public function __construct(InformationRepository $newVehicleRepository)
    {
        $this->vehicleRepository = $newVehicleRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $vehicles = $this->vehicleRepository->findAll();
        $modelChoices = [];
        $brandChoices = [];
        $categoryChoices = [];
        $cylindersChoices = [];

        foreach ($vehicles as $vehicle) {    
            $brand = $vehicle->getBrand();
            $category = $vehicle->getCategory();
            $cylinders = $vehicle->getCylinders();
            $model = $vehicle->getModel();
     
            if ($brand) {
                $brandChoices[$brand] = $brand;
            }
            if ($category) {
                $categoryChoices[$category] = $category;
            }
            if ($model) {
                $modelChoices[$model] = $model;
            }
            if ($cylinders) {
                $cylindersChoices[$cylinders] = $cylinders;
            }
        }
 
        $brandChoices = array_unique($brandChoices);
        $categoryChoices = array_unique($categoryChoices);
        $modelChoices = array_unique($modelChoices);
        $cylindersChoices = array_unique($cylindersChoices);

        $builder
            ->add('brand', ChoiceType::class, [
                'choices' => array_unique($brandChoices),
                'placeholder' => 'Choisissez un marque',
                'required' => false,
            ])
            ->add('category', ChoiceType::class, [
                'choices' => array_unique($categoryChoices),
                'placeholder' => 'Choisissez une catégorie',
                'required' => false,
            ])
            ->add('model', ChoiceType::class, [
                'choices' => array_unique($modelChoices),
                'placeholder' => 'Choisissez un modèle',
                'required' => false,
            ])
            ->add('cylinders', ChoiceType::class, [
                'choices' => array_unique($cylindersChoices),
                'placeholder' => 'Choisissez le cylindrés',
                'required' => false,
            ])
            ->add('A2', CheckboxType::class, [
                'required' => false,
            ])
            ->add('availableForTrial', CheckboxType::class, [
                'required' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Rechercher',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
            'method' => 'GET',
        ]);
    }
}
