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
    // Création du formulaire
    $form = $this->createForm(NewVehicleFilterForm::class);
    $form->handleRequest($request);

    $qb = $repo->createQueryBuilder('v')
        ->leftJoin('v.information', 'i')
        ->addSelect('i');

    // Par défaut, on récupère tous les véhicules
    $vehicles = $qb->getQuery()->getResult();

    // Si le formulaire est soumis et valide, on filtre
    if ($form->isSubmitted() && $form->isValid()) {
        $data = array_filter($form->getData() ?? []);
        
        $qb = $repo->createQueryBuilder('v')
            ->leftJoin('v.information', 'i')
            ->addSelect('i');

        foreach ($data as $field => $value) {
            if ($value !== null && $value !== '') {
                // Champs dans Information
                if (in_array($field, ['brand', 'category', 'model'])) {
                    $qb->andWhere("i.$field LIKE :$field")
                       ->setParameter($field, "%$value%");
                }
                // Champs spéciaux (booleens)
                elseif (in_array($field, ['A2', 'availableForTrial'])) {
                    $qb->andWhere("i.$field = :$field")
                       ->setParameter($field, $value);
                }
                // Champ JSON (license) – méthode fragile
                elseif ($field === 'license') {
                    $qb->andWhere("i.license LIKE :license")
                       ->setParameter('license', "%$value%");
                }
            }
        }

        $vehicles = $qb->getQuery()->getResult();
    }

    return $this->render('pages/new-vehicle.html.twig', [
        'newVehicleFilterForm' => $form->createView(),
        'vehicles' => $vehicles,
    ]);
}

}