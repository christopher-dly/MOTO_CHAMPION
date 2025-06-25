<?php 

namespace App\Controller;

use App\Entity\VehicleMaintenance;
use App\Form\VehicleMaintenanceForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminVehicleMaintenanceController extends AbstractController
{
    #[Route('/admin/vehicle_maintenance', name: 'AdminVehicleMaintenance')]
    public function adminVehicleMaintenance(EntityManagerInterface $entityManager)
    {
        $vehicleMaintenances = $entityManager->getRepository(VehicleMaintenance::class)->findAll();

        return $this->render('admin/vehicle_maintenance.html.twig', [
            'vehicleMaintenances' => $vehicleMaintenances,
        ]);
    }

    #[Route('/admin/vehicle_maintenance/add', name: 'AdminVehicleMaintenanceAdd')]
    public function adminVehicleMaintenanceAdd(Request $request, EntityManagerInterface $entityManager)
    {
        $maintenance = new VehicleMaintenance(); // Instancier l'entité

        $form = $this->createForm(VehicleMaintenanceForm::class, $maintenance); // Lier l'entité au formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($maintenance); // On persiste l'objet
            $entityManager->flush();

            return $this->redirectToRoute('AdminVehicleMaintenance');
        }

        return $this->render('admin/vehicle_maintenance_add.html.twig', [
            'addVehicleMaintenanceForm' => $form->createView(),
        ]);
    }

    #[Route('/admin/vehicle_maintenance/delete/{id}', name: 'AdminVehicleMaintenanceDelete')]
    public function adminVehicleMaintenanceDelete(EntityManagerInterface $entityManager, int $id)
    {
        $entityManager->remove($entityManager->getRepository(VehicleMaintenance::class)->find($id));
        $entityManager->flush();

        return $this->redirectToRoute('AdminVehicleMaintenance');
    }

    #[Route('/admin/vehicle_maintenance/edit/{id}', name: 'AdminVehicleMaintenanceEdit')]
    public function adminVehicleMaintenanceEdit(Request $request, EntityManagerInterface $entityManager, int $id)
    {
        $maintenance = $entityManager->getRepository(VehicleMaintenance::class)->find($id);

        $form = $this->createForm(VehicleMaintenanceForm::class, $maintenance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($maintenance);
            $entityManager->flush();

            return $this->redirectToRoute('AdminVehicleMaintenance');
        }

        return $this->render('admin/vehicle_maintenance_edit.html.twig', [
            'addVehicleMaintenanceForm' => $form->createView(),
        ]);
    }   
}