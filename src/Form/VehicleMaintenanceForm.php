<?php 

namespace App\Form;

use App\Entity\VehicleMaintenance;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehicleMaintenanceForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('brand', TextType::class, [
                'required' => true
            ])
            ->add('model', TextType::class, [
                'required' => true
            ])
            ->add('year', IntegerType::class, [
                'required' => true
            ])
            ->add('vehicleMaintenanceLittle', VehicleMaintenanceLittleForm::class)
            ->add('vehicleMaintenanceMedium', VehicleMaintenanceMediumForm::class)
            ->add('vehicleMaintenanceLarge', VehicleMaintenanceLargeForm::class)
            ->add('vehicleMaintenanceXLarge', VehicleMaintenanceXLargeForm::class)
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VehicleMaintenance::class,
        ]);
    }
}