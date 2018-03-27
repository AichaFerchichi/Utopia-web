<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Promotions;
use UserBundle\Form\PromotionsType;

class PromotionsController extends Controller
{
    public function gestionPromotionsAction(Request $request, $id)
    {
        //ajout
        $voiture= new Promotions();
        $form=$this->createForm(PromotionsType::class,$voiture);
        $em=$this->getDoctrine()->getManager();
        $prod=$em->getRepository('UserBundle:Produits')->find($id) ;
        $nom=$prod->getNom() ;
        $voiture->setIdProduit($prod) ;
        $ancienPrix = $prod->getPrixProduit() ;


        if ($form->handleRequest($request)->isValid())
        {
            $em->persist($voiture);
            $p=$voiture->getPourcentage();
            $nouvPrix= $ancienPrix - ($ancienPrix*$p/100);
            $voiture->setPrixpromo($nouvPrix) ;
            //$prod->setPrixProduit($nouvPrix) ;
            $em->flush();
            return $this->redirectToRoute('affichagePromotions');
        }

        return $this->render('BackBundle:Default:promotionProduits.html.twig', array(
            'e'=>$nom, 'f'=>$form->createView() , 'id'=> $id , 'a'=>$prod->getImage()
        ));
    }


    public function afficherAction(){
        //affichage
        $em=$this->getDoctrine()->getManager();
        $query=$em->createQueryBuilder()
            ->delete('UserBundle:Promotions','p')
            ->where('p.dateFin < CURRENT_DATE()')
            ->getQuery();

        $query->execute();

        $marks=$em->getRepository('UserBundle:Promotions')->findAll();


        return $this->render('BackBundle:Default:affichagePromotions.html.twig', array(
            'm'=>$marks
        ));
    }






    public function supprimerPromotionAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $equipe=$em->find(Promotions::class,$id);
        $em->remove($equipe);
        $em->flush();
        return $this->redirectToRoute('affichagePromotions');
    }

    public function modifierPromotionAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager() ;
        $mark=$em->getRepository('UserBundle:Promotions')->find($id) ;
        $form=$this->createForm(PromotionsType::class,$mark) ;
        $prod=$em->getRepository('UserBundle:Produits')->find($mark->getIdProduit()->getIdProduit()) ;
        $ancienPrix = $prod->getPrixProduit() ;


        if($form->handleRequest($request)->isValid())
        {
            $em->persist($mark) ;
            $p=$mark->getPourcentage();
            $nouvPrix= $ancienPrix - ($ancienPrix*$p/100);
            $mark->setPrixpromo($nouvPrix) ;
            $em->flush() ;
            return $this->redirectToRoute('affichagePromotions') ;
        }        return $this->render('BackBundle:Default:modifierPromotion.html.twig',array(  'f'=>$form->createView())) ;

    }

}
