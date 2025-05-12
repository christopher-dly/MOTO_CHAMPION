<?php

namespace App\Controller;

use App\Entity\NewVehicle;
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

        $qb = $repo->createQueryBuilder('v')
            ->leftJoin('v.information', 'i')
            ->addSelect('i');

        $vehicles = $qb->getQuery()->getResult();

        if ($form->isSubmitted() && $form->isValid()) {
            $data = array_filter($form->getData() ?? []);
            
            $qb = $repo->createQueryBuilder('v')
                ->leftJoin('v.information', 'i')
                ->addSelect('i');

                foreach ($data as $field => $value) {
                    if ($value !== null && $value !== '') {

                        if (in_array($field, ['brand', 'category', 'model'])) {
                            $qb->andWhere("i.$field LIKE :$field")
                            ->setParameter($field, "%$value%");
                        }

                        elseif ($field === 'A2') {
                            $qb->andWhere("i.A2 = :A2")
                            ->setParameter('A2', $value);
                        }

                        elseif ($field === 'availableForTrial') {
                            $qb->andWhere("i.availableForTrial = :availableForTrial")
                            ->setParameter('availableForTrial', $value);
                        }
                    }
                }

            $vehicles = $qb->getQuery()->getResult();
        }

        return $this->render('pages/new_vehicle.html.twig', [
            'newVehicleFilterForm' => $form->createView(),
            'vehicles' => $vehicles,
        ]);
    }

    #[Route('/new-vehicle/{id}', name: 'NewVehicleDetail')]
    public function newVehicleDetail(NewVehicle $newVehicle): Response
    {
        return $this->render('pages/new_vehicle_detail.html.twig', [
            'vehicle' => $newVehicle,
        ]);
    }

}