<?php

namespace App\Repository;

use App\Entity\UsedVehicleImage;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class UsedVehicleImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $doctrine)
    {
        parent::__construct($doctrine, UsedVehicleImage::class);
    }
}