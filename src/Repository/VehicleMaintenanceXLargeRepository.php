<?php

namespace App\Repository;

use App\Entity\VehicleMaintenanceXLarge;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class VehicleMaintenanceXLargeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VehicleMaintenanceXLarge::class);
    }
}