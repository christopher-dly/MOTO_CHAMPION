<?php

namespace App\Controller;

use App\Form\WorkshopForm;
use App\Repository\VehicleMaintenanceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WorkShopController extends AbstractController
{
    #[Route('/Atelier', name: 'Workshop')]
    public function search(Request $request, VehicleMaintenanceRepository $vehicleRepo): Response
    {
        $form = $this->createForm(WorkshopForm::class, null, [
            'vehicle_repository' => $vehicleRepo,
        ]);
        $form->handleRequest($request);

        $vehicleMaintenance = null;

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData(); 
            
            $vehicleMaintenance = $vehicleRepo->findOneBy([
                'brand' => $data['brand'],
                'model' => $data['model'],
                'year' => $data['year'],
            ]);
        }
        return $this->render('pages/workshop.html.twig', [
            'workshop_form' => $form->createView(),
            'vehicleMaintenance' => $vehicleMaintenance,
        ]);
    }
}