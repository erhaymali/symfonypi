<?php

namespace App\Controller;


use App\Entity\Reclamation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Routing\Annotation\Route;

class JSONAPIController extends AbstractController
{
 


    #[Route('/display', name: 'display')]

    public function allReclamationsAction()
{
    $em = $this->getDoctrine()->getManager();
    $reclamations = $em->getRepository(Reclamation::class)->findAll();

    $serializer = $this->get('serializer');
    $data = $serializer->normalize($reclamations, null, ['attributes' => ['id', 'sujet', 'contenu', 'etat']]);

    return new JsonResponse($data);
}

    public function getReclamationAction(Request $request)
{
    $id = $request->query->get("id");
    $em = $this->getDoctrine()->getManager();
    $reclamation = $em->getRepository(Reclamation::class)->find($id);

    if ($reclamation) {
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($reclamation);
        return new JsonResponse($formatted);
    } else {
        return new Response("Reclamation not found", 404);
    }
}

#[Route('/editRec', name: 'editRec')]

public function editReclamationAction(Request $request)
{
    $em = $this->getDoctrine()->getManager();
    $id = $request->get("id");
    $contenu = $request->get("contenu");
    $note = $request->get("etat");
    $sujet = $request->get("sujet");

    $reclamation = $em->getRepository(Reclamation::class)->find($id);

    if (!$reclamation) {
        return new Response("Reclamation not found", 404);
    }

    // Update reclamation properties as needed
    // Update reclamation properties as needed
    $reclamation->setSujet(urldecode($sujet));
    // Update reclamation properties as $cong
    $reclamation->setContenu($contenu);


    try {
        $em->persist($reclamation);
        $em->flush();
        return new Response("Reclamation updated successfully");
    } catch (\Exception $ex) {
        return new Response("Failed to update reclamation");
    }
}

#[Route('/deleteRec', name: 'deleteRec')]

public function deleteReclamationAction(Request $request)
{
    $em = $this->getDoctrine()->getManager();
    $id = $request->get("id");

    $reclamation = $em->getRepository(Reclamation::class)->find($id);

    if (!$reclamation) {
        return new Response("Reclamation not found", 404);
    }

    try {
        $em->remove($reclamation);
        $em->flush();
        return new Response("Reclamation deleted successfully");
    } catch (\Exception $ex) {
        return new Response("Failed to delete reclamation");
    }
}

#[Route('/createRec', name: 'createRec')]

public function createReclamationAction(Request $request)
{
    $em = $this->getDoctrine()->getManager();
    $contenu = $request->get("contenu");
    $sujet = $request->get("sujet");
    $etat = $request->get("etat");

    // You may need to retrieve the user and other related entities based on your application's logic.

    $reclamation = new Reclamation();
    $reclamation->setContenu(urldecode($contenu));
    $reclamation->setEtat($etat); // adi variable
    $reclamation->setSujet($sujet);

    try {
        $em->persist($reclamation);
        $em->flush();
        return new Response("Reclamation created successfully");
    } catch (\Exception $ex) {
        return new Response($ex);
    }
}




}