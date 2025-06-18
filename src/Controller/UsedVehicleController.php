<?php

namespace App\Controller;

use App\Repository\UsedVehicleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsedVehicleController extends AbstractController
{
    #[Route('/véhicules-doccasion', name: 'UsedVehicle')]
    public function usedVehicle(UsedVehicleRepository $repo): Response
    {
        $usedVehicles = $repo->findAll();

        return $this->render('pages/used_vehicle.html.twig', [
            'usedVehicles' => $usedVehicles,
        ]);
    }

    #[Route('/véhicules-doccasion/{id}', name: 'UsedVehicleDetails')]
    public function usedVehicleDetails(UsedVehicleRepository $repo, int $id): Response
    {
        $usedVehicle = $repo->find($id);
        $images = $usedVehicle->getUsedVehicleImages();

        return $this->render('pages/used_vehicle_details.html.twig', [
            'usedVehicle' => $usedVehicle,
            'images' => $images,
        ]);
    }
}
