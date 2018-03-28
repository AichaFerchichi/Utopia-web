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
        /*$voiture2= new Produits();
        $form2=$this->createForm(RechercherProduits::class,$voiture2);
        if ($form2->handleRequest($request)->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $marks=$em->getRepository('UserBundle:Produits')->findBy(array('categorie'=>$voiture2->getCategorie()));
        }*/

        return $this->render('BackBundle:Default:gestionProduits.html.twig', array(
            'm'=>$marks , 'f'=>$form->createView()
        ));


    }

    public function supprimerAction($id){
        $em=$this->getDoctrine()->getManager();
        $equipe=$em->find(Produits::class,$id);
        $em->remove($equipe);
        $em->flush();
        return $this->redirectToRoute('gestionProduits');
    }

    public function modifierAction($id,Request $request){

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

    public function rechercherAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        $motcle=$request->get('motcle');
        $repository=$em->getRepository('UserBundle:Produits');
        $query=$em->createQueryBuilder()
            ->select('p')->from('UserBundle:Produits','p')
            ->where('p.categorie like :categorie')
            ->setParameter('categorie','%'.$motcle.'%')
            ->orderBy('p.categorie','ASC')
            ->getQuery();

        $produits=$query->getResult();
//ajout
        $joueur= new Produits();


        $form=$this->createForm(ProduitsType::class,$joueur);
        if ($form->handleRequest($request)->isValid())
        {/**
         * @var UploadedFile $file
         */
            $file=$joueur->getImage() ;
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('image_directory'),$fileName) ;
            $joueur->setImage($fileName) ;
            $em->persist($joueur) ;
            $em->flush() ;
            return $this->redirectToRoute('gestionProduits') ;

        }

        return $this->render('BackBundle:Default:gestionProduits.html.twig',array('m'=>$produits,'f'=>$form->createView()));
    }

    public function affichageProduitsAction(){
        $em=$this->getDoctrine()->getManager();
        $marks=$em->getRepository('UserBundle:Produits')->findAll();
        return $this->render('FrontBundle:Default:Boutique.html.twig', array(
            'm'=>$marks
        ));
    }

    public function singleAction($id){
        $em=$this->getDoctrine()->getManager();
        $marks=$em->getRepository('UserBundle:Produits')->find($id);
        $voitures=$em->getRepository('UserBundle:Promotions')->findOneBy(array('idProduit'=>$id)) ;
        $mot='vêtements';
        $query=$em->createQueryBuilder()
            ->select('p')->from('UserBundle:Produits','p')
            ->where('p.categorie like :categorie')
            ->setParameter('categorie','%'.$mot.'%')
            ->setMaxResults(4)
            ->getQuery();

        $some=$query->getResult();


        return $this->render('FrontBundle:Default:single.html.twig', array(
            'i'=>$marks , 'e'=>$voitures , 'some'=>$some
        ));
    }

    public function single2Action($id){
        $em=$this->getDoctrine()->getManager();
        $marks=$em->getRepository('UserBundle:Produits')->find($id);
        $voitures=$em->getRepository('UserBundle:Promotions')->findOneBy(array('idProduit'=>$id)) ;
        $mot='jouets';
        $query=$em->createQueryBuilder()
            ->select('p')->from('UserBundle:Produits','p')
            ->where('p.categorie like :categorie')
            ->setParameter('categorie','%'.$mot.'%')
            ->setMaxResults(4)
            ->getQuery();

        $some=$query->getResult();
        return $this->render('FrontBundle:Default:single2.html.twig', array(
            'i'=>$marks , 'e'=>$voitures , 'some'=>$some
        ));
    }

    public function single3Action($id){
        $em=$this->getDoctrine()->getManager();
        $marks=$em->getRepository('UserBundle:Produits')->find($id);
        $voitures=$em->getRepository('UserBundle:Promotions')->findOneBy(array('idProduit'=>$id)) ;
        $mot='fournitures';
        $query=$em->createQueryBuilder()
            ->select('p')->from('UserBundle:Produits','p')
            ->where('p.categorie like :categorie')
            ->setParameter('categorie','%'.$mot.'%')
            ->setMaxResults(4)
            ->getQuery();

        $some=$query->getResult();
        return $this->render('FrontBundle:Default:single3.html.twig', array(
            'i'=>$marks , 'e'=>$voitures , 'some'=>$some
        ));
    }

    public function nosJouetsAction(){
        $em=$this->getDoctrine()->getManager();
        $marks=$em->getRepository('UserBundle:Produits')->findBy(array('categorie'=>'jouets'));
        return $this->render('FrontBundle:Default:nosJouets.html.twig', array(
            'm'=>$marks
        ));
    }
    public function nosVetementsAction(){
        $em=$this->getDoctrine()->getManager();
        $marks=$em->getRepository('UserBundle:Produits')->findBy(array('categorie'=>'vêtements'));
        return $this->render('FrontBundle:Default:nosVetements.html.twig', array(
            'm'=>$marks
        ));
    }

    public function nosFournituresAction(){
        $em=$this->getDoctrine()->getManager();
        $marks=$em->getRepository('UserBundle:Produits')->findBy(array('categorie'=>'fournitures'));
        return $this->render('FrontBundle:Default:nosFournitures.html.twig', array(
            'm'=>$marks
        ));
    }


}
