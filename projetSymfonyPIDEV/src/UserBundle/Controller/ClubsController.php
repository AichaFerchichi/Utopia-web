<?php

namespace UserBundle\Controller;


use UserBundle\Entity\Clubs;
use UserBundle\Form\ClubsType;

use UserBundle\Form\InscriptionType;
use UserBundle\Form\RechercheForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Enseignants;


class ClubsController extends Controller
{
    public function afficherClubsFrontAction()
    {
        $em = $this->getDoctrine()->getManager();

        $clubs = $em->getRepository("UserBundle:Clubs")->findAll();
        return $this->render('FrontBundle:Default:Clubs.html.twig', array('c'=>$clubs));
    }
    public function devenirPartenaireAction()
    {
        $em = $this->getDoctrine()->getManager();
        return $this->render('FrontBundle:Default:devenirPartenaire.html.twig');
    }
    public function indexAction()
    {
        return $this->render('BackBundle:Default:table_bootstrap.html.twig');
    }
    public function ajoutAction(Request $request)
    {
        $joueur= new Clubs();


        $form=$this->createForm(ClubsType::class,$joueur);

        if ($form->handleRequest($request)->isValid())
        {/**
         * @var UploadedFile $file
         */
            $file=$joueur->getImage() ;
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('image_directory'),$fileName) ;
            $joueur->setImage($fileName) ;
            $em=$this->getDoctrine()->getManager();
           $joueur->setTotalaimer(0);
$joueur->setTotalpasaimer(0);
$joueur->setDateAjout((new \DateTime('now')));
            $em->persist($joueur);
            $em->flush();
            //return $this->redirectToRoute('affiche');
            return $this->redirectToRoute('table_bootstrap');

        }
        $em=$this->getDoctrine()->getManager();
        $equipes=$em->getRepository('UserBundle:Clubs')->findAll();


        return $this->render('BackBundle:Default:table_bootstrap.html.twig',array('f'=>$form->createView(),'m'=>$equipes));

    }

    public function rechercherParNomClubAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $motcle=$request->get('motcle');
        $repository=$em->getRepository('UserBundle:Clubs');
        $query=$em->createQueryBuilder()
            ->select('p')->from('UserBundle:Clubs','p')
            ->where('p.nomClub like :nomClub')
            ->setParameter('nomClub','%'.$motcle.'%')
            ->orderBy('p.nomClub','ASC')
            ->getQuery();

        $clubs=$query->getResult();
        return $this->render('FrontBundle:Default:Clubs.html.twig',array('c'=>$clubs));
    }

    public function rechercherComboAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $motcle=$request->get('combo');
        $repository=$em->getRepository('UserBundle:Clubs');
        $query=$em->createQueryBuilder()
            ->select('p')->from('UserBundle:Clubs','p')
            ->where('p.categorie like :categorie')
            ->setParameter('categorie','%'.$motcle.'%')
            ->orderBy('p.categorie','ASC')
            ->getQuery();

        $clubs=$query->getResult();
        return $this->render('FrontBundle:Default:Clubs.html.twig',array('c'=>$clubs));
    }


    public function rechercherAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        $motcle=$request->get('motcle');
        $repository=$em->getRepository('UserBundle:Clubs');
        $query=$em->createQueryBuilder()
            ->select('p')->from('UserBundle:Clubs','p')
            ->where('p.categorie like :categorie')
            ->setParameter('categorie','%'.$motcle.'%')
            ->orderBy('p.categorie','ASC')
            ->getQuery();

        $produits=$query->getResult();
//ajout
        $joueur= new Clubs();


        $form=$this->createForm(ClubsType::class,$joueur);
        if ($form->handleRequest($request)->isValid())
        {/**
         * @var UploadedFile $file
         */
            $file=$joueur->getImage() ;
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('image_directory'),$fileName) ;
            $joueur->setImage($fileName) ;
            $em=$this->getDoctrine()->getManager();

            $em->persist($joueur);
            $em->flush();
            //return $this->redirectToRoute('affiche');
            return $this->redirectToRoute('table_bootstrap');

        }

        return $this->render('BackBundle:Default:table_bootstrap.html.twig',array('m'=>$produits,'f'=>$form->createView()));
    }

    /*public function affichageAction()
    {
        $marque=new Enfants();

        $em=$this->getDoctrine()->getManager();

        $equipes=$em->getRepository('UserBundle:Enfants')->findAll();

        return $this->render('BackBundle:Default:email_read2.html.twig', array(
            'm'=>$equipes));

    }*/
    public function modifierAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $mark = $em->getRepository('UserBundle:Clubs')->find($id);
        $form = $this->createForm(ClubsType::class, $mark);
        if ($form->handleRequest($request)->isValid()) {
            /**
             * @var UploadedFile $file
             */
            $file=$mark->getImage() ;
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('image_directory'),$fileName) ;
            $mark->setImage($fileName);
            $em->persist($mark);
            $em->flush();
            return $this->redirectToRoute('table_bootstrap');
        }
        return $this->render('BackBundle:Default:modifierClub.html.twig', array('f' => $form->createView()));
    }


    public function deleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $equipe=$em->find(Clubs::class,$id);
        $em->remove($equipe);
        $em->flush();
        return $this->redirectToRoute('table_bootstrap');
    }
}
