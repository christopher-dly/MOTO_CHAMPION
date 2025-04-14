<?php

namespace App\Controller;

use App\Entity\Actuality;
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
        return $this->render('pages/index.html.twig', ['actualitys' => $actuality]);
    }
    
    #[Route('/admin', name: 'Admin')]
    public function admin()
    {
        return $this->render('admin/home.html.twig');
    }
}


