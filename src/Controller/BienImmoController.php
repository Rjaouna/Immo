<?php

namespace App\Controller;

use App\Entity\BienImmo;
use App\Form\BienImmoType;
use App\Repository\BienImmoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/')]
class BienImmoController extends AbstractController
{
    #[Route('/bienimmo', name: 'app_bien_immo_index', methods: ['GET'])]
    public function index(BienImmoRepository $bienImmoRepository): Response
    {
        // Récupérer tous les biens immobiliers
        $bienImmos = $bienImmoRepository->findAll();

        // Initialiser un tableau pour stocker le nombre de messages pour chaque bienImmo
        $messageCounts = [];

        // Parcourir chaque BienImmo pour obtenir le nombre de messages associés
        foreach ($bienImmos as $bienImmo) {
            $messageCount = count($bienImmo->getMessages()); // Nombre de messages pour ce BienImmo
            $messageCounts[$bienImmo->getId()] = $messageCount; // Stocker le nombre de messages par ID de BienImmo
        }
        return $this->render('bien_immo/index.html.twig', [
            'bien_immos' => $bienImmoRepository->findAll(),
            'message_counts' => $messageCounts, 
        ]);
    }

    #[Route('/new', name: 'app_bien_immo_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $bienImmo = new BienImmo();
        $form = $this->createForm(BienImmoType::class, $bienImmo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($bienImmo);
            $entityManager->flush();

            return $this->redirectToRoute('app_bien_immo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('bien_immo/new.html.twig', [
            'bien_immo' => $bienImmo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bien_immo_show', methods: ['GET'])]
    public function show(BienImmo $bienImmo): Response
    {
        return $this->render('bien_immo/show.html.twig', [
            'bien_immo' => $bienImmo,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_bien_immo_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BienImmo $bienImmo, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BienImmoType::class, $bienImmo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_bien_immo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('bien_immo/edit.html.twig', [
            'bien_immo' => $bienImmo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bien_immo_delete', methods: ['POST'])]
    public function delete(Request $request, BienImmo $bienImmo, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bienImmo->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($bienImmo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_bien_immo_index', [], Response::HTTP_SEE_OTHER);
    }
}
