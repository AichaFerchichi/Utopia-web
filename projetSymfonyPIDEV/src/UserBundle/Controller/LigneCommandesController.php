<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Lignecommandes;

class LigneCommandesController extends Controller
{
    public function ajouterLigneCommandeAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        if ($user=='anon.')
            return $this->redirectToRoute('fos_user_security_login');


        else {
            $marque = new Lignecommandes();
            if ($request->getMethod()=="POST"){
                $x=$request->get('identifiant');
                $voiture= $em->getRepository("UserBundle:Produits")->find($x);
                $marque->setIdProduit($voiture) ;
                $marque->setPrixProduit($voiture->getPrixProduit()) ;
                $y=$request->get('selection');
                $marque->setQuantite($y)  ;
                $marque->setIdParent($user) ;
                $em=$this->getDoctrine()->getManager();
                $em->persist($marque); //insert into
                $em->flush(); //query
                return $this->redirectToRoute('wishlist');
            }
            return $this->render('UserBundle:LigneCommandes:ajouter_ligne_commande.html.twig', array(
                // ...
            ));
        }
    }


    public function afficherLigneCommandeAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        if ($user=='anon.')
            return $this->redirectToRoute('fos_user_security_login');


        else {
         /*   $marque = new Livraisons();
            $form=$this->createForm(LivraisonsType::class,$marque);
            if ($form->handleRequest($request)->isValid())
            {
                //var_dump($marque);
                $em1=$this->getDoctrine()->getManager();
                $em1->persist($marque);
                $em1->flush();
                return $this->redirectToRoute('wishlist');
            } */
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $yo= $em->getRepository("UserBundle:Lignecommandes")->findBy(array('idParent'=>$user));

            $emm = $this->getDoctrine()->getManager();
            $yo2= $emm->getRepository("UserBundle:Commandes")->findBy(array('idParent'=>$user));
        return $this->render('FrontBundle:Default:wishlist.html.twig', array(
           'm'=>$yo , 'com'=>$yo2 ,// 'f'=>$form->createView()
        ));}
    }

    public function supprimerLigneCommandeAction($id){
        $em=$this->getDoctrine()->getManager();
        $voiture=$em->find(Lignecommandes::class,$id);
        $em->remove($voiture);
        $em->flush();
        return $this->redirectToRoute('wishlist');
    }

}
