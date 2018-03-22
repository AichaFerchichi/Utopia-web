<?php

namespace UserBundle\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile ;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Produits;
use UserBundle\Form\modifProduitsType;
use UserBundle\Form\ProduitsType;
use UserBundle\Form\RechercherProduits;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProduitsController extends Controller
{
    public function gestionProduitsAction(Request $request)
    {
        //ajout
        $voiture= new Produits();
        $form=$this->createForm(ProduitsType::class,$voiture);
        if ($form->handleRequest($request)->isValid())
        {
            /**
             * @var UploadedFile $file
             */
            $file=$voiture->getImage() ;
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('image_directory'),$fileName) ;
            $voiture->setImage($fileName) ;
            $em=$this->getDoctrine()->getManager();
            $em->persist($voiture);
            $em->flush();
            return $this->redirectToRoute('gestionProduits');
        }

        //affichage
        $em=$this->getDoctrine()->getManager();
        $marks=$em->getRepository('UserBundle:Produits')->findAll();


        //rechercher
        $voiture2= new Produits();
        $form2=$this->createForm(RechercherProduits::class,$voiture2);
        if ($form2->handleRequest($request)->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $marks=$em->getRepository('UserBundle:Produits')->findBy(array('categorie'=>$voiture2->getCategorie()));
        }

        return $this->render('BackBundle:Default:gestionProduits.html.twig', array(
            'm'=>$marks , 'f'=>$form->createView() , 'f2'=>$form2->createView()
        ));


    }

    public function supprimerAction($id){
        $em=$this->getDoctrine()->getManager();
        $equipe=$em->find(Produits::class,$id);
        $em->remove($equipe);
        $em->flush();
        return $this->redirectToRoute('gestionProduits');
    }

    function modifierAction($id,Request $request){

        $em=$this->getDoctrine()->getManager() ;
        $mark=$em->getRepository('UserBundle:Produits')->find($id) ;
        $form=$this->createForm(ProduitsType::class,$mark) ;
        $name=$mark->getNom() ;

        if($form->handleRequest($request)->isValid())
        {
            /**
             * @var UploadedFile $file
             */
            $file=$mark->getImage() ;
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('image_directory'),$fileName) ;
            $mark->setImage($fileName) ;
            $em->persist($mark) ;
            $em->flush() ;
            return $this->redirectToRoute('gestionProduits') ;
        }        return $this->render('BackBundle:Default:modifierProduits.html.twig',array( 'e'=> $name , 'f'=>$form->createView())) ;
    }

}
