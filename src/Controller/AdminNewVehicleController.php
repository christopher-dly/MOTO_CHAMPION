<?php

namespace App\Controller;

use App\Entity\NewVehicle;
use App\Form\EditNewVehicleForm;
use App\Form\NewVehicleForm;
use App\Repository\InformationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class AdminNewVehicleController extends AbstractController
{
    #[Route('/admin/véhicules-neufs', name: 'AdminNewVehicle', methods: ['GET', 'POST'])]
    public function adminNewVehicle(InformationRepository $informationRepository)
    {
        $newVehicleTrails = $informationRepository->findBy(['category' => 'Trail']);
        $newVehicleSports = $informationRepository->findBy(['category' => 'Sport / GT']);
        $newVehicleRoadsters = $informationRepository->findBy(['category' => 'Roadster']);
        $newVehicleScooters = $informationRepository->findBy(['category' => 'Scooter']);
        $newVehicleMoto125s = $informationRepository->findBy(['category' => 'Moto 125']);

        return $this->render('admin/new_vehicle.html.twig', [
            'newVehicleTrails' => $newVehicleTrails,
            'newVehicleSports' => $newVehicleSports,
            'newVehicleRoadsters' => $newVehicleRoadsters,
            'newVehicleScooters' => $newVehicleScooters,
            'newVehicleMoto125s' => $newVehicleMoto125s,
        ]);
    }

    #[Route('/admin/véhicules-neufs/ajouter', name: 'AdminNewVehicleAdd', methods: ['GET', 'POST'])]
    public function adminNewVehicleAdd(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger)
    {
        $newVehicle = new NewVehicle();
        $form = $this->createForm(NewVehicleForm::class, $newVehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($form->get('newVehicleImages') as $key => $imageForm) {
                $uploadedFile = $imageForm->get('image')->getData();

                if ($uploadedFile) {
                    $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename . '-' . uniqid() . '.' . $uploadedFile->guessExtension();

                    try {
                        $uploadedFile->move(
                            $this->getParameter('images_directory'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                        $this->addFlash('error', 'Erreur lors de l\'upload');
                        continue;
                    }

                    $imageEntity = $newVehicle->getNewVehicleImages()[$key] ?? null;

                    if ($imageEntity) {
                        $imageEntity->setImage($newFilename);
                        $imageEntity->setNewVehicle($newVehicle);
                    }
                } else {
                    $newVehicle->getNewVehicleImages()->remove($key);
                }
            }

            $entityManager->persist($newVehicle);
            $entityManager->flush();

            return $this->redirectToRoute('AdminNewVehicle');
        }

        return $this->render('admin/new_vehicle_add.html.twig', [
            'add_new_vehicle_form' => $form->createView(),
        ]);
    }

    #[Route('/admin/véhicules-neufs/editer/{id}', name: 'AdminNewVehicleEdit', methods: ['GET', 'POST'])]
    public function adminNewVehicleEdit(Request $request, EntityManagerInterface $entityManager, NewVehicle $newVehicle, SluggerInterface $slugger)
    {
        $form = $this->createForm(EditNewVehicleForm::class, $newVehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('AdminNewVehicle');
        }

        return $this->render('admin/new_vehicle_edit.html.twig', [
            'edit_new_vehicle_form' => $form->createView(),
        ]);
    }

    #[Route('/admin/véhicules-neufs/supprimer/{id}', name: 'AdminNewVehicleDelete', methods: ['GET', 'POST'])]
    public function adminUsedVehicleDelete(Request $request, EntityManagerInterface $entityManager, NewVehicle $newVehicle)
    {
        $entityManager->remove($newVehicle);
        $entityManager->flush();

        return $this->redirectToRoute('AdminNewVehicle');
    }
}



