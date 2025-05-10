<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UsedVehicleController extends AbstractController
{
    #[Route('/used-vehicle', name: 'UsedVehicle')]
    public function usedVehicle()
    {
        return $this->render('pages/used_Vehicle.html.twig');
    }
}
