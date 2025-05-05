<?php

namespace App\Controller;

use App\Entity\UsedVehicle;
use App\Form\UsedVehicleForm;
use App\Form\EditUsedVehicleForm;
use App\Repository\UsedVehicleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class AdminUsedVehicleController extends AbstractController
{
    #[Route('/admin/used-vehicle', name: 'AdminUsedVehicle', methods: ['GET','POST'])]
    public function adminUsedVehicle(UsedVehicleRepository $usedVehiclesRepository)
    {   
        $usedVehicles = $usedVehiclesRepository->findAll();

        return $this->render('admin/used_vehicle.html.twig', [
            'usedVehicles' => $usedVehicles,
        ]);
    }

    #[Route('/admin/used-vehicle/add', name: 'AdminUsedVehicleAdd', methods: ['GET','POST'])]
    public function adminUsedVehicleAdd(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger)
    {
        $usedVehicle = new UsedVehicle();
        $form = $this->createForm(UsedVehicleForm::class, $usedVehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            foreach ($form->get('usedVehicleImages') as $key => $imageForm) {
                /** @var UploadedFile|null $uploadedFile */
                $uploadedFile = $imageForm->get('image')->getData();

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

                    $imageEntity = $usedVehicle->getUsedVehicleImages()[$key] ?? null;

                    if ($imageEntity) {
                        $imageEntity->setImage($newFilename);
                        $imageEntity->setUsedVehicle($usedVehicle);
                    }
                    } else {
                        $usedVehicle->getUsedVehicleImages()->remove($key);
                    }
                }

            $entityManager->persist($usedVehicle);
            $entityManager->flush();

            return $this->redirectToRoute('AdminUsedVehicle');
        }
        return $this->render('admin/used_vehicle_add.html.twig', [
            'add_used_vehicle_form' => $form->createView(),
        ]);
    }

    #[Route('/admin/used-vehicle/edit/{id}', name: 'AdminUsedVehicleEdit', methods: ['GET','POST'])]
    function adminUsedVehicleEdit(Request $request, EntityManagerInterface $entityManager, UsedVehicle $usedVehicle)
    {
        $form = $this->createForm(EditUsedVehicleForm::class, $usedVehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('AdminUsedVehicle');
        }

        return $this->render('admin/used_vehicle_edit.html.twig', [
            'edit_used_vehicle_form' => $form->createView(),
        ]);
    }

    #[Route('/admin/used-vehicle/delete/{id}', name: 'AdminUsedVehicleDelete', methods: ['GET','POST'])]
    public function adminUsedVehicleDelete(Request $request, EntityManagerInterface $entityManager, UsedVehicle $usedVehicle)
    {
        $entityManager->remove($usedVehicle);
        $entityManager->flush();

        return $this->redirectToRoute('AdminUsedVehicle');
    }
}
