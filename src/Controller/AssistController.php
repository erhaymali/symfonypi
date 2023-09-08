<?php
// src/Controller/AssistController.php

namespace App\Controller;

use App\Entity\Assist;
use App\Entity\Reclamation;
use App\Form\AssistType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AssistController extends AbstractController
{
    // ...


    /**
     * @Route("/assist/addAssist", name="assist_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $assist = new Assist();
        $form = $this->createForm(AssistType::class, $assist);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($assist);
            $entityManager->flush();

            return $this->redirectToRoute('list_assist'); // Redirect to the list view
        }

        return $this->render('assist/addAssist.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/assist/display', name: 'list_assist')]
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $query = $this->getDoctrine()->getRepository(Assist::class)->findAll();

        $assists = $paginator->paginate(
            $query,      // Query to paginate
            $request->query->getInt('page', 1), // Current page number
            2          // Items per page
        );

        return $this->render('assist/displayAssist.html.twig', [
            'assists' => $assists,
        ]);
    }


    #[Route('/assist/{id}', name: 'assist_show', methods: ['GET'])]
    public function show(Assist $assist): Response
    {
        return $this->render('assist/show.html.twig', [
            'assist' => $assist,
        ]);
    }

    #[Route('/assist/{id}/edit', name: 'assist_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Assist $assist): Response
    {
        $form = $this->createForm(AssistType::class, $assist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('list_assist');
        }

        return $this->render('assist/editAssist.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/assist/delete/{id}', name: 'assist_delete',)]

    public function delete(Assist $assist): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($assist);
        $entityManager->flush();

        $this->addFlash('danger', 'assist deleted successfully!');

        return $this->redirectToRoute('list_assist');
    }
    // ...
    #[Route('/ajax_search', name: 'ajax_search',)]

    public function searchAction(Request $request, EntityManagerInterface $entityManager)
    {

        $requestString = $request->query->get('q'); // Use query to get query parameters

        $entities = $entityManager->getRepository(Assist::class)->findEntitiesByString($requestString);

        if (!$entities) {
            $result['entities']['error'] = "Assist n'existe pas";
        } else {
            $result['entities'] = $this->getRealEntities($entities);
        }

        return new JsonResponse($result); // Use JsonResponse to return JSON
    }

    public function getRealEntities($entities){

        foreach ($entities as $entity){
            $realEntities[$entity->getId()] = [$entity->getQuestion(),$entity->getReponse()];
        }

        return $realEntities;
    }

}
