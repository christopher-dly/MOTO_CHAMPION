<?php

namespace App\Controller;

use App\Entity\Actuality;
use App\Entity\NewVehicle;
use App\Entity\UsedVehicle;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'Home')]
    public function index(EntityManagerInterface $em): Response
    {
        $actuality = $em->getRepository(Actuality::class)->findBy([], ['date' => 'DESC'], 5);
        $newVehicles = $em->getRepository(NewVehicle::class)->findAll();
        $usedVehicles = $em->getRepository(UsedVehicle::class)->findAll();
        return $this->render('pages/index.html.twig', [
            'actualitys' => $actuality, 
            'newVehicles' => $newVehicles, 
            'usedVehicles' => $usedVehicles]);
    }
    
    #[Route('/admin', name: 'Admin')]
    public function admin()
    {
        return $this->render('admin/home.html.twig');
    }
}


