<?php

namespace App\Form;

use App\Entity\UsedVehicle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsedVehicleForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('brand', TextType::class)
            ->add('model', TextType::class)
            ->add('category', TextType::class)
            ->add('cylinders', TextType::class)
            ->add('price', TextType::class)
            ->add('warrantyTime', TextType::class)
            ->add('description', TextType::class)
            ->add('availableForTrial', TextType::class)
            ->add('color', TextType::class)
            ->add('year', TextType::class)
            ->add('kilometers', TextType::class)
            ->add('energyTax', TextType::class)
            ->add('taxPower', TextType::class)
            ->add('power', TextType::class)
            ->add('statue', TextType::class)
            ->add('UsedVehicleImageForm', UsedVehicleImageForm::class)
            ->add('submit', SubmitType::class);
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UsedVehicle::class,
        ]);
    }
}