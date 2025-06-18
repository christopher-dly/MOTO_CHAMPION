<?php 

namespace App\Controller;

use App\Entity\Actuality;
use App\Form\NewActualityForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class AdminActualityController extends AbstractController
{
    #[Route('/actualités', name: 'Actuality')]
    public function actuality()
    {
        return $this->render('pages/actuality.html.twig');
    }

    #[Route('/admin/actualités', name: 'AdminActuality', methods: ['GET','POST'])]
    public function adminActuality(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $showActuality = $entityManager->getRepository(Actuality::class)->findBy([], ['date' => 'DESC']);
        
        $actuality = new Actuality();
        $form = $this->createForm(NewActualityForm::class, $actuality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();

            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = uniqid().'.'.$imageFile->guessExtension();
                $newFilename = $safeFilename;

                try {
                    $imageFile->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (\Exception $e) {
                    $this->addFlash('error', 'Erreur lors de l\'upload');
                    return $this->redirectToRoute('AdminActualityAdd');
                }

                $actuality->setImage($newFilename);
            }
            $entityManager->persist($actuality);
            $entityManager->flush();

            $this->addFlash('success', 'L\'article a bien été ajouté');

            return $this->redirectToRoute('AdminActuality');
        }

        return $this->render('admin/actuality.html.twig', [
            'actualitys' => $showActuality,
            'actualityForm' => $this->createForm(NewActualityForm::class),
        ]);
    }

    #[Route('/admin/actualités/supprimer/{id}', name: 'ActualityDelete', methods: ['GET', 'POST'])]
    public function delete(Request $request, Actuality $article, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($article);
        $entityManager->flush();

        return $this->redirectToRoute('AdminActuality');
    }
}
