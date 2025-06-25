<?php

namespace App\Repository;

use App\Entity\VehicleMaintenanceMedium;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class VehicleMaintenanceMediumRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VehicleMaintenanceMedium::class);
    }
}