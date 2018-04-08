<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\Commandes;
use UserBundle\Entity\Lignecommandes;

class CommandesController extends Controller
{
    public function ajouterCommandeAction(Request $request,$id)
    {
        $marque = new Commandes();
        $em = $this->getDoctrine()->getManager();
        if($request->getMethod()=="POST"){

            $voiture= $em->getRepository("UserBundle:Lignecommandes")->find($id);
            $total = $voiture->getQuantite()* $voiture->getPrixProduit() ;
            if($voiture->getIdParent()->getMontant()>=$total) {

                //modifier le montant
                $em3 = $this->getDoctrine()->getManager();
                $v= $em3->getRepository("UserBundle:User")->find($voiture->getIdParent());
                $v->setMontant($v->getMontant()-$total) ;
                $em3->persist($v) ;
                $em3->flush() ;

                //modifier la quantite
                $em2 = $this->getDoctrine()->getManager();
                $qte= $em2->getRepository("UserBundle:Produits")->find($voiture->getIdProduit()->getIdProduit());
                $qte->setQuantite($qte->getQuantite()-$voiture->getQuantite()) ;
                $em2->persist($qte) ;
                $em2->flush() ;

                //ajouter la commande
                $marque->setIdLigne($voiture);
                $marque->setIdParent($voiture->getIdParent());
                $marque->setTotal($total);
                $marque->setDate(new \DateTime('now')) ;
                $emm=$this->getDoctrine()->getManager();
                $emm->persist($marque);
                $emm->flush();
                return $this->redirectToRoute('wishlist'); }
            else {

               /* $request->getSession()
                    ->getFlashBag()
                    ->add('danger', 'Votre montant est insuffisant! Veuillez recharger votre carte bancaire')
                ;*/

                return $this->redirectToRoute('wishlistAlerte');
            // return new Response('votre montant est insuffisant! Veuillez recharger votre carte bancaire');
            }
        }

        return $this->render('UserBundle:Lignecommandes:wishlist.html.twig', array(
            // ...
        ));
    }


    public function afficherCommandeAction(){
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        if ($user=='anon.')
            return $this->redirectToRoute('fos_user_security_login');

        else {
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $em = $this->getDoctrine()->getManager();
            $yo= $em->getRepository("UserBundle:Commandes")->findBy(array('idParent'=>$user));
            return $this->render('FrontBundle:Default:index.html.twig', array(
                'com'=>$yo
            ));}
    }

    public function afficherCommandesAction(){
        $em = $this->getDoctrine()->getManager();
        $em2 = $this->getDoctrine()->getManager();
        $yo= $em->getRepository("UserBundle:Commandes")->findAll();
        $yo2= $em2->getRepository("UserBundle:Livraisons")->findAll();
        return $this->render('BackBundle:Default:afficherCommandes.html.twig', array(
            'm'=>$yo  , 'm2'=>$yo2
        ));
    }

    public function supprimerCommandeAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $equipe=$em->find(Commandes::class,$id);
        $em->remove($equipe);
        $em->flush();
        return $this->redirectToRoute('wishlist');
    }


}
