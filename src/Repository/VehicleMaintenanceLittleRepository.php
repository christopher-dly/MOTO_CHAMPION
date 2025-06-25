<?php

namespace App\Repository;

use App\Entity\VehicleMaintenanceLittle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class VehicleMaintenanceLittleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VehicleMaintenanceLittle::class);
    }
}