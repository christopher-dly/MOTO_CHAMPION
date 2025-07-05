<?php
// src/Controller/AthentificationController.php
namespace App\Controller;

use App\Entity\User;
use App\Form\UserForm;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController {

  #[Route('/nouvelle-administrateur', name: 'app_register')]
  public function inscription(
    Request $request,
    UserRepository $repository,
    UserPasswordHasherInterface $passwordHasher
  ) {
    $user = new User();
    $form = $this->createForm(UserForm::class, $user);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

      $hashedPassword = $passwordHasher->hashPassword(
        $user,
        $user->getPassword()
      );

      $user->setPassword($hashedPassword);

      $repository->save($user, true);

      return $this->redirectToRoute('Admin');
    }

    return $this->render('admin/administrator.html.twig', [
      'registrationForm' => $form->createView(),
    ]);
  }

  #[Route('/login', name: 'app_login')]
  public function connexion(): Response {
    // Implementer le login plus tard
    return $this->render('admin/login.html.twig', [
      'controller_name' => 'LoginController',
    ]);
  }
}