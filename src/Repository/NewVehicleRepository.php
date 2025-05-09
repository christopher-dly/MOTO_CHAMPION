<?php

namespace App\Repository;

use App\Entity\NewVehicle;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class NewVehicleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $doctrine)
    {
        parent::__construct($doctrine, NewVehicle::class);
    }

    public function findByFilters(array $filters): array
{
    $qb = $this->createQueryBuilder('v')
        ->leftJoin('v.information', 'i')
        ->addSelect('i');

    if (!empty($filters['brand'])) {
        $qb->andWhere('i.brand LIKE :brand')
           ->setParameter('brand', '%' . $filters['brand'] . '%');
    }

    if (!empty($filters['category'])) {
        $qb->andWhere('i.category LIKE :category')
           ->setParameter('category', '%' . $filters['category'] . '%');
    }

    if (!empty($filters['model'])) {
        $qb->andWhere('i.model LIKE :model')
           ->setParameter('model', '%' . $filters['model'] . '%');
    }

    if (!empty($filters['cylinders'])) {
        $qb->andWhere('i.cylinders = :cylinders')
           ->setParameter('cylinders', $filters['cylinders']);
    }

    if (!is_null($filters['A2'])) {
        $qb->andWhere('i.A2 = :A2')
           ->setParameter('A2', $filters['A2']);
    }

    if (!is_null($filters['availableForTrial'])) {
        $qb->andWhere('i.availableForTrial = :available')
           ->setParameter('available', $filters['availableForTrial']);
    }

    return $qb->getQuery()->getResult();
}

}   