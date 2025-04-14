{% extends "layout.html.twig" %}

{% block main %}
    <h1>(admin)AJOUTEZ UN VÉHICULE NEUF</h1>
<div>
{{ form_start(form, {'attr': {'enctype': 'multipart/form-data'}}) }}
    {{ form_row(form.name) }}
    {{ form_row(form.Information) }}
    {{ form_row(form.Engine) }}
    {{ form_row(form.Transmission) }}
    {{ form_row(form.Dimension) }}
    {{ form_row(form.CyclePart) }}

    <div id="vehicle_images" data-prototype="{{ form_widget(form.newVehicleImages.vars.prototype)|e('html_attr') }}">
        {% for imageForm in form.newVehicleImages %}
            <div class="image-entry">
                {{ form_row(imageForm.image) }}
            </div>
        {% endfor %}
    </div>

    <button type="button" id="add_image">Ajouter une image</button>

    {{ form_row(form.submit) }}
{{ form_end(form) }}

</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.querySelector('#vehicle_images');
        const addButton = document.querySelector('#add_image');
        let index = container.querySelectorAll('.image-entry').length;

        addButton.addEventListener('click', function () {
            const prototype = container.dataset.prototype;
            const newForm = prototype.replace(/__name__/g, index);
            const div = document.createElement('div');
            div.classList.add('image-entry');
            div.innerHTML = newForm;

            container.appendChild(div);
            index++;
        });
    });
</script>

{% endblock %}











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











#[Route('/admin/new-vehicle/add', name: 'AdminNewVehicleAdd', methods: ['GET','POST'])]
    public function adminNewVehicleAdd(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger)
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