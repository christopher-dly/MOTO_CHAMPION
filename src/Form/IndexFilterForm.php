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
                    '- 5000 €' => '-5000',
                    '5001 - 6000 €' => '5001-6000',
                    '6001 - 7000 €' => '6001-7000',
                    '7001 - 8000 €' => '7001-8000',
                    '8001 - 9000 €' => '8001-9000',
                    '9001 - 10000 €' => '9001-10000',
                    '10001 - 11000 €' => '10001-11000',
                    '11001 - 12000 €' => '11001-12000',
                    '12001 - 13000 €' => '12001-13000',
                    '13001 - 14000 €' => '13001-14000',
                    '14001 - 15000 €' => '14001-15000',
                    '15001 - 16000 €' => '15001-16000',
                    '16001 - 17000 €' => '16001-17000',
                    '17001 - 18000 €' => '17001-18000',
                    '18001 - 19000 €' => '18001-19000',
                    '19001 - 20000 €' => '19001-20000',
                    '+ de 20000 €' => '+20000',
                ],
                'placeholder' => 'Choisissez une tranche de prix',
                'required' => false,
            ])
            ->add('cylinders', ChoiceType::class, [
                'label' => 'Cylindrée',
                'choices' => $cylindersChoices,
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
