<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/admin/contact', name: 'AdminContact', methods: ['GET','POST'])]
    public function adminContact(): Response
    {
        return $this->render('admin/contact.html.twig');
    }

    #[Route('/contact', name: 'Contact')]
    public function contact(): Response
    {
        return $this->render('pages/contact.html.twig');
    }
}