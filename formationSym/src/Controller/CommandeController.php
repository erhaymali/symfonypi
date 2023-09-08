<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Form\CommandeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{




    /**
     * @Route("/Commandes", name="display_cmd")
     */
    public function index(): Response
    {

        $em = $this->getDoctrine()->getManager()->getRepository(Commande::class); // ENTITY MANAGER ELY FIH FONCTIONS PREDIFINES

        $prods = $em->findAll(); // Select * from Commandes;
        return $this->render('commande/index.html.twig', ['listP'=>$prods]);
    }




    /**
     * @Route("/ajouterCommande", name="ajouterCommande")
     */
    public function ajouterCommande(Request $request): Response
    {

        $prod = new Commande(); // init objet
        $form = $this->createForm(CommandeType::class,$prod);

        $form->handleRequest($request); // bch man5srhomich ya3ni les donnees yab9o persisté



        if($form->isSubmitted() && $form->isValid()) {


            $em = $this->getDoctrine()->getManager(); // ENTITY MANAGER ELY FIH FONCTIONS PREDIFINES
            $em->persist($prod);//ajout
            $em->flush();// commit

            return $this->redirectToRoute('ajouterCommande');

        }

        return $this->render('commande/createCommande.html.twig',
            ['f'=>$form->createView()]
        );
    }


    /**
     * @Route("/modifierCommande/{id}", name="modifierCommande")
     */
    public function modifierCommande(Request $request,$id): Response
    {
        $prod= $this->getDoctrine()->getManager()->getRepository(Commande::class)->find($id);

        $form = $this->createForm(CommandeType::class,$prod);

        $form->handleRequest($request); // bch man5srhomich ya3ni les donnees yab9o persisté



        if($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager(); // ENTITY MANAGER ELY FIH FONCTIONS PREDIFINES
            $em->persist($prod);//ajout
            $em->flush();// commit

            return $this->redirectToRoute('display_cmd');

        }

        return $this->render('commande/modifierCommande.html.twig',
            ['f'=>$form->createView()]
        );
    }

    /**
     * @Route("/suppressionCommande/{id}", name="suppressionCommande")
     */
    public function suppressionCommande(Commande  $prod): Response
    {

        $em = $this->getDoctrine()->getManager();// ENTITY MANAGER ELY FIH FONCTIONS PREDIFINES
        $em->remove($prod);
        //MISE A JOURS
        $em->flush();

        return $this->redirectToRoute('display_cmd');
    }






}