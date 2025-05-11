<?php

namespace App\Controller;

use App\Repository\UsedVehicleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsedVehicleController extends AbstractController
{
    #[Route('/used-vehicle', name: 'UsedVehicle')]
    public function usedVehicle(UsedVehicleRepository $repo): Response
    {
        $usedVehicles = $repo->findAll();

        return $this->render('pages/used_vehicle.html.twig', [
            'usedVehicles' => $usedVehicles,
        ]);
    }
}
