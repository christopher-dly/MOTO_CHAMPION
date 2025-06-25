<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehicleSearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $cylindersChoices = ['- de 125 cm³' => '0-125'];
        for ($start = 200; $start < 1300; $start += 100) {
        $end = $start + 100;
        $label = "{$start} - {$end} cm³";
        $value = "{$start}-{$end}";
        $cylindersChoices[$label] = $value;
    }
    $cylindersChoices['+ de 1300 cm³'] = '1300+';

        $builder
            ->add('type', ChoiceType::class, [
                'label' => 'Type de véhicule',
                'choices' => [
                    'Neuf' => 'new',
                    'Occasion' => 'used',
                ],
                'placeholder' => 'Neuf ou Occasion',
                'required' => true,
            ])
            ->add('A2', CheckboxType::class, [
                'label' => 'Compatible A2',
                'required' => false,
            ])
            ->add('category', ChoiceType::class, [
                'label' => 'Catégorie',
                'choices' => [
                    'Trail' => 'Trail',
                    'Sport / GT' => 'Sport / GT',
                    'Roadster' => 'Roadster',
                    'Scooter' => 'Scooter',
                    'Moto 125' => 'Moto 125',
                ],
                'placeholder' => 'Choisissez une catégorie',
                'required' => false,
            ])
            ->add('price', ChoiceType::class, [
                'label' => 'Tranche de prix',
                'choices' => [
                    '- 3000 €' => '-3000',
                    '3001 - 6000 €' => '3001-6000',
                    '6001 - 10000 €' => '6001-10000',
                    '10001 - 15000 €' => '10001-15000',
                    '+ 15000 €' => '+15000',
                ],
                'placeholder' => 'Choisissez une tranche de prix',
                'required' => false,
            ])
            ->add('cylinders', ChoiceType::class, [
                'label' => 'Cylindrée',
                'choices' => [
                    '50 cm³' => '50',
                    '125 cm³' => '125',
                    '126 cm³ - 400 cm³' => '126-400',
                    '401 cm³ - 600 cm³' => '401-600',
                    '601 cm³ - 800 cm³' => '601-800',
                    '801 cm³ - 1000 cm³' => '801-1000',
                    '1001 cm³ - 1300 cm³' => '1001-1300',
                    '+ 1300 cm³' => '+1300',
                ],
                'placeholder' => 'Choisissez une cylindrée',
                'required' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Rechercher',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }
}
