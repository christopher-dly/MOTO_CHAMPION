<?php

namespace App\Controller;

use App\Entity\NewVehicle;
use App\Form\NewVehicleForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'Home')]
    public function index(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger)
    {
        $newVehicle = new NewVehicle();
        $form = $this->createForm(NewVehicleForm::class, $newVehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // On récupère tous les sous-formulaires d'images
            foreach ($form->get('newVehicleImages') as $key => $imageForm) {
                /** @var UploadedFile|null $uploadedFile */
                $uploadedFile = $imageForm->get('image')->getData();
        
                // Vérifie s'il y a un fichier
                if ($uploadedFile) {
                    $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename.'-'.uniqid().'.'.$uploadedFile->guessExtension();
        
                    try {
                        $uploadedFile->move(
                            $this->getParameter('images_directory'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                        $this->addFlash('error', 'Erreur lors de l\'upload');
                        continue;
                    }
        
                    // Maintenant on récupère l'entité pour lui setter le nom de fichier
                    $imageEntity = $newVehicle->getNewVehicleImages()[$key] ?? null;
        
                    if ($imageEntity) {
                        $imageEntity->setImage($newFilename);
                        $imageEntity->setNewVehicle($newVehicle);
                    }
                } else {
                    // Si aucun fichier, on évite de persister une image vide
                    $newVehicle->getNewVehicleImages()->remove($key);
                }
            }
        
            $entityManager->persist($newVehicle);
            $entityManager->flush();
        
            return $this->redirectToRoute('Home');
        }

        return $this->render('pages/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
