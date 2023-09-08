<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Panier;
use App\Form\CommandeType;
use App\Form\PanierType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="app_panier")
     */
    public function index(): Response
    {
        return $this->render('panier/index.html.twig', [
            'controller_name' => 'PanierController',
        ]);
    }


    /**
     * @Route("/affichagePanier", name="affichagePanier")
     */
    public function affichagePanier(): Response
    {

        $em = $this->getDoctrine()->getManager()->getRepository(Panier::class); // ENTITY MANAGER ELY FIH FONCTIONS PREDIFINES

        $prods = $em->findAll(); // Select * from Commandes;
        return $this->render('panier/affichagePanier.html.twig', ['listP'=>$prods]);
    }




    /**
     * @Route("/ajouterPanier", name="ajouterPanier")
     */
    public function ajouterPanier(Request $request): Response
    {

        $prod = new Panier(); // init objet
        $form = $this->createForm(PanierType::class,$prod);

        $form->handleRequest($request); // bch man5srhomich ya3ni les donnees yab9o persisté



        if($form->isSubmitted() && $form->isValid()) {


            $em = $this->getDoctrine()->getManager(); // ENTITY MANAGER ELY FIH FONCTIONS PREDIFINES
            $em->persist($prod);//ajout
            $em->flush();// commit

            return $this->redirectToRoute('affichagePanier');

        }

        return $this->render('panier/createPanier.html.twig',
            ['f'=>$form->createView()]
        );
    }


    /**
     * @Route("/modifierPanier/{id}", name="modifierPanier")
     */
    public function modifierPanier(Request $request,$id): Response
    {
        $prod= $this->getDoctrine()->getManager()->getRepository(Panier::class)->find($id);

        $form = $this->createForm(PanierType::class,$prod);

        $form->handleRequest($request); // bch man5srhomich ya3ni les donnees yab9o persisté



        if($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager(); // ENTITY MANAGER ELY FIH FONCTIONS PREDIFINES
            $em->persist($prod);//ajout
            $em->flush();// commit

            return $this->redirectToRoute('affichagePanier');

        }

        return $this->render('panier/modifierPanier.html.twig',
            ['f'=>$form->createView()]
        );
    }


    /**
     * @Route("/suppressionPanier/{id}", name="suppressionPanier")
     */
    public function suppressionPanier(Panier  $prod): Response
    {

        $em = $this->getDoctrine()->getManager();// ENTITY MANAGER ELY FIH FONCTIONS PREDIFINES
        $em->remove($prod);
        //MISE A JOURS
        $em->flush();

        return $this->redirectToRoute('affichagePanier');
    }


}
