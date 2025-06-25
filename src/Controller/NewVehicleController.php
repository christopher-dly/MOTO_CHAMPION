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
    #[Route('/véhicules-neufs', name: 'NewVehicle')]
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

                        if (in_array($field, ['brand', 'category', 'model', 'cylinders'])) {
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

    #[Route('/véhicules-neufs/{id}', name: 'NewVehicleDetail')]
    public function newVehicleDetail(NewVehicle $newVehicle): Response
    {
        $images = $newVehicle->getNewVehicleImages();

        $colorMap = [
            'rouge' => '#FF0000',
            'bleu' => 'var(--blue)',
            'noir' => '#000000',
            'blanc' => '#FFFFFF',
            'gris' => '#808080',
            'vert' => '#008000',
            'jaune' => '#FFFF00',
            'orange' => '#FFA500',
            'rose' => '#FFC0CB',
            'violet' => '#800080',
            'marron' => '#8B4513',
            'beige' => '#F5F5DC',
        ];

        $colors = [];

        foreach ($images as $image) {
            $colorName = strtolower(trim($image->getColor()));
            if ($colorName && !isset($colors[$colorName]) && isset($colorMap[$colorName])) {
                $colors[$colorName] = $colorMap[$colorName];
            }
        }

        return $this->render('pages/new_vehicle_detail.html.twig', [
            'vehicle' => $newVehicle,
            'images' => $images,
            'colors' => $colors,
        ]);
    }
}
