<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Livraisons;
use UserBundle\Form\LivraisonsType;

class LivraisonsController extends Controller
{
    public function ajouterLivraisonAction(Request $request, $id)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $yo= $em->getRepository("UserBundle:Commandes")->findBy(array('idParent'=>$user));
        if ($user=='anon.')
            return $this->redirectToRoute('fos_user_security_login');





        else {
            $marque = new Livraisons();
            $form=$this->createForm(LivraisonsType::class,$marque);
            if ($form->handleRequest($request)->isValid())
            {
                //var_dump($marque);
                $livreur= $em->getRepository("UserBundle:User")->findOneBy(array('disponibilite'=>1));
                if($livreur!=null){
                    $marque->setIdLivreur($livreur) ;
                    $livreur->setDisponibilite(0) ;
                }
                else {
                    return $this->redirectToRoute('FormulaireLivraisonAlerte');
                }
                $marque->setIdParent($user) ;
                $prod= $em->getRepository("UserBundle:Produits")->find($id);
                $marque->setIdProduit($prod) ;

                if($marque->getAdresse()=="Ariana"){
                    $marque->setDuree(20) ;
                }
                if($marque->getAdresse()=="Tunis"){
                    $marque->setDuree(30) ;
                }
                if($marque->getAdresse()=="Ben Arous"){
                    $marque->setDuree(45) ;
                }
                if($marque->getAdresse()=="Manouba"){
                    $marque->setDuree(50) ;
                }

                $em=$this->getDoctrine()->getManager();
                $em->persist($marque);
                $em->flush();
                return $this->redirectToRoute('FormulaireLivraison2',array('id'=>$marque->getIdLivraison()));
            }
            return $this->render('FrontBundle:Default:FormulaireLivraison.html.twig', array(
                'f'=>$form->createView() , 'com'=>$yo
            ));
        }
    }

    public function afficherMessageAction($id){

        $em=$this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $yo= $em->getRepository("UserBundle:Commandes")->findBy(array('idParent'=>$user));
        $livraison= $em->getRepository("UserBundle:Livraisons")->find($id) ;
        return $this->render('FrontBundle:Default:FormulaireLivraison2.html.twig', array(
            'duree'=> $livraison->getDuree() , 'com'=>$yo
        ));
    }



}
