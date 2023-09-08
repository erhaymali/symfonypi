<?php

namespace App\Controller;

// src/Controller/ReclamationController.php
namespace App\Controller;

use App\Entity\Reclamation;
use App\Form\ReclamationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReclamationController extends AbstractController
{
    #[Route('/', name: 'app_reclamation')]
    public function index(): Response
    {
        return $this->render('reclamation/index.html.twig', [
            'controller_name' => 'ReclamationController',
        ]);
    }

    #[Route('/edit-reclamation/{id}', name: 'edit_reclamation')]
    public function editReclamation(Request $request, Reclamation $reclamation): Response
    {
        $form = $this->createForm(ReclamationType::class, $reclamation);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Save the edited reclamation
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Reclamation updated successfully!');

            return $this->redirectToRoute('app_reclamation_display');
        }

        return $this->render('reclamation/editReclamation.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/delete-reclamation/{id}', name: 'delete_reclamation')]
    public function deleteReclamation(Reclamation $reclamation): RedirectResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($reclamation);
        $entityManager->flush();

        $this->addFlash('success', 'Reclamation deleted successfully!');

        return $this->redirectToRoute('app_reclamation_display');
    }

    #[Route('/reclamation/add', name: 'app_reclamation_add')]
    public function add(Request $request): Response
    {
        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $reclamation);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $reclamation->setUtilisateurId(1);
            $reclamation->setAssistId(1);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reclamation);
            $this->addFlash('success', 'Reclamation added successfully!'); // Add success flash message

            $entityManager->flush();

            // You can add a success flash message here if needed

            return $this->redirectToRoute('app_reclamation_add');
        }

        return $this->render('reclamation/addReclamation.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/reclamation/display', name: 'app_reclamation_display')]
    public function display(Request $request, EntityManagerInterface $entityManager): Response
    {
        $sortBy = $request->query->get('sort', 'id'); // Default sorting by id
        $sortDirection = $request->query->get('direction', 'asc'); // Default sorting direction

        $reclamations = $entityManager
            ->getRepository(Reclamation::class)
            ->createQueryBuilder('r')
            ->orderBy('r.' . $sortBy, $sortDirection)
            ->getQuery()
            ->getResult();

        return $this->render('reclamation/display.html.twig', [
            'reclamations' => $reclamations,
        ]);
    }


}
