<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class VehicleMaintenanceController extends AbstractController
{
    #[Route('/tarif_atelier', name: 'VehicleMaintenance')]
    public function vehicleMaintenance()
    {
        return $this->render('pages/vehicle_maintenance.html.twig');
    }   
}