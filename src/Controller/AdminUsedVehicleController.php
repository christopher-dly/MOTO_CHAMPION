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
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

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
    
    #[Route('/admin/used-vehicle/{id}/hide', name: 'used_vehicle_hide')]
    public function hide(UsedVehicle $usedVehicle, EntityManagerInterface $em, Request $request): RedirectResponse
    {
        $usedVehicle->setStatue(false);
        $em->flush();

        $this->addFlash('success', 'Le véhicule a été masqué.');
        return $this->redirect($request->headers->get('referer') ?? $this->generateUrl('admin_used_vehicle_list'));
    }

    #[Route('/admin/used-vehicle/{id}/show', name: 'used_vehicle_show')]
    public function show(UsedVehicle $usedVehicle, EntityManagerInterface $em, Request $request): RedirectResponse
    {
        $usedVehicle->setStatue(true);
        $em->flush();

        $this->addFlash('success', 'Le véhicule est maintenant visible.');
        return $this->redirect($request->headers->get('referer') ?? $this->generateUrl('admin_used_vehicle_list'));
    }

    #[Route('/admin/used-vehicle/{id}/sell', name: 'used_vehicle_sell')]
    public function usedVehicleSell(UsedVehicle $usedVehicle, EntityManagerInterface $em, Request $request): RedirectResponse
    {
        $usedVehicle->setSelled(true);
        $usedVehicle->setSoldAt(new \DateTime());

        $em->flush();

        $this->addFlash('success', 'Le véhicule a été marqué comme vendu.');

        return $this->redirect($request->headers->get('referer') ?? $this->generateUrl('admin_used_vehicle_list'));
    }

    #[Route('/admin/used-vehicle/sold/list', name: 'used_vehicle_sold_list')]
    public function usedVehicleSoldList(UsedVehicleRepository $repository): Response
    {
        $soldVehicles = $repository->findSoldVehicles();

        return $this->render('admin/used_vehicle_sold_list.html.twig', [
            'vehicles' => $soldVehicles,
        ]);
    }
}
