<?php

namespace App\Controller;

use App\Entity\Actuality;
use App\Entity\NewVehicle;
use App\Entity\UsedVehicle;
use App\Form\VehicleSearchFormType;
use App\Repository\NewVehicleRepository;
use App\Repository\UsedVehicleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'Home')]
    public function index(Request $request, EntityManagerInterface $em, NewVehicleRepository $newRepo, UsedVehicleRepository $usedRepo): Response {
        $form = $this->createForm(VehicleSearchFormType::class);
        $form->handleRequest($request);

        $actuality = $em->getRepository(Actuality::class)->findBy([], ['date' => 'DESC'], 5);
        $vehicles = [];

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $type = $data['type'] ?? null;

            if ($type === 'used') {
                $qb = $usedRepo->createQueryBuilder('v');

                if (!empty($data['category'])) {
                    $qb->andWhere('v.category = :category')
                        ->setParameter('category', $data['category']);
                }

                if (!empty($data['A2'])) {
                    $qb->andWhere('v.a2 = true');
                }

                if (!empty($data['cylinders'])) {
                    $this->applyCylindersFilter($qb, 'v', $data['cylinders']);
                }

                if (!empty($data['price'])) {
                    $this->applyPriceFilter($qb, 'v', $data['price']);
                }

                $vehicles = $qb->getQuery()->getResult();
            } elseif ($type === 'new') {
                $qb = $newRepo->createQueryBuilder('v')
                    ->join('v.information', 'i');

                if (!empty($data['category'])) {
                    $qb->andWhere('i.category = :category')
                        ->setParameter('category', $data['category']);
                }

                if (!empty($data['A2'])) {
                    $qb->andWhere('i.a2 = true');
                }

                if (!empty($data['cylinders'])) {
                    $this->applyCylindersFilter($qb, 'i', $data['cylinders']);
                }

                if (!empty($data['price'])) {
                    $this->applyPriceFilter($qb, 'i', $data['price']);
                }

                $vehicles = $qb->getQuery()->getResult();
            } else {
                // Si aucun type n’est sélectionné, on récupère tout
                $vehicles = array_merge(
                    $usedRepo->findAll(),
                    $newRepo->createQueryBuilder('v')->join('v.information', 'i')->getQuery()->getResult()
                );
            }
        }

        return $this->render('pages/index.html.twig', [
            'indexFilterForm' => $form->createView(),
            'vehicles' => $vehicles,
            'actualitys' => $actuality,
        ]);
    }

    private function applyCylindersFilter($qb, string $alias, string $range): void
    {
        if ($range === '0-125') {
            $qb->andWhere("$alias.cylinders < 125");
        } elseif ($range === '1300+') {
            $qb->andWhere("$alias.cylinders > 1300");
        } else {
            [$min, $max] = explode('-', $range);
            $qb->andWhere("$alias.cylinders BETWEEN :minCyl AND :maxCyl")
                ->setParameter('minCyl', (int)$min)
                ->setParameter('maxCyl', (int)$max);
        }
    }

    private function applyPriceFilter($qb, string $alias, string $range): void
    {
        if ($range === '-5000') {
            $qb->andWhere("$alias.price <= 5000");
        } elseif ($range === '+20000') {
            $qb->andWhere("$alias.price > 20000");
        } else {
            [$min, $max] = explode('-', $range);
            $qb->andWhere("$alias.price BETWEEN :minPrice AND :maxPrice")
                ->setParameter('minPrice', (int)$min)
                ->setParameter('maxPrice', (int)$max);
        }
    }

    #[Route('/admin', name: 'Admin')]
    public function admin(): Response
    {
        return $this->render('admin/home.html.twig');
    }
}
