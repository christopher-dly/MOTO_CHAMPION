<?php

namespace App\Controller;

use App\Form\UserForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
  // Code Précédent ...

  #[Route('/login', name: 'app_login')]
  public function login(Request $request, AuthenticationUtils $authenticationUtils) {
    $error = $authenticationUtils->getLastAuthenticationError();
    $lastEmail = $authenticationUtils->getLastUsername();

    $form = $this->createForm(UserForm::class);

    return $this->render('admin/login.html.twig', [
      'last_email' => $lastEmail,
      'error' => $error,
      'loginForm' => $form->createView(),
    ]);
  }
}
