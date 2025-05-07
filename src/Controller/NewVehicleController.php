<?php

namespace App\Controller;

use App\Form\NewVehicleFilterForm;
use App\Repository\NewVehicleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewVehicleController extends AbstractController
{
    #[Route('/new-vehicle', name: 'NewVehicle')]
    public function newVehicle(Request $request, NewVehicleRepository $repo): Response
    {
        $form = $this->createForm(NewVehicleFilterForm::class);
        $form->handleRequest($request);

        return $this->render('pages/new-vehicle.html.twig', [
            'newVehicleFilterForm' => $form->createView()
        ]);
    }
}