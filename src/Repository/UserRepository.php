<?php

namespace App\Repository;

use App\Entity\Admin;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $doctrine)
    {
        parent::__construct($doctrine, User::class);
    }

  public function save(User $nouveauUser, ?bool $flush = false) {

    $this->getEntityManager()->persist($nouveauUser);

    if($flush){
      $this->getEntityManager()->flush();
    }
    return $nouveauUser;
  }
}