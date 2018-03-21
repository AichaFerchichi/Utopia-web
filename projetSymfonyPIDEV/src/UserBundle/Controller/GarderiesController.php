<?php

namespace UserBundle\Controller;


use UserBundle\Form\RechercheForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Garderies;
use UserBundle\Form\GarderiesType;

class GarderiesController extends Controller
{
    public function indexAction()
    {
        return $this->render('BackBundle:Default:email_compose.html.twig');
    }
    public function ajoutAction(Request $request)
    {
        $joueur= new Garderies();


        $form=$this->createForm(GarderiesType::class,$joueur);
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
            return $this->redirectToRoute('email_compose');

        }
        $em=$this->getDoctrine()->getManager();
        $equipes=$em->getRepository('UserBundle:Garderies')->findAll();

        $voiture2= new Garderies();
        $form2=$this->createForm(RechercheForm::class,$voiture2);
        if ($form2->handleRequest($request)->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $equipes=$em->getRepository('UserBundle:Garderies')->find($voiture2->getNom());
        }
        return $this->render('BackBundle:Default:email_compose.html.twig',array('f'=>$form->createView(),'m'=>$equipes,'f2'=>$form2->createView()));

    }
    public function rechercherAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $marks=$em->getRepository('UserBundle:Garderies')->findAll();
        $marque=new Garderies();
        $form=$this->createForm(RechercheForm::class,$marque);
        if($form->handleRequest($request)->isValid()){
            $marks=$em->getRepository('UserBundle:Garderies')->findBy($marque->getNom());

        }
        return $this->render('BackBundle:Default:email_compose.html.twig', array(
            'm'=>$marks,'f'=>$form->createView()
        ));
    }
    public function affichageAction()
    {
        $marque=new Garderies();

        $em=$this->getDoctrine()->getManager();

        $equipes=$em->getRepository('UserBundle:Garderies')->findAll();

        return $this->render('BackBundle:Default:email_compose.html.twig', array(
            'm'=>$equipes));

    }
    public function modifierAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $mark = $em->getRepository('UserBundle:Garderies')->find($id);
        $form = $this->createForm(GarderiesType::class, $mark);
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
            return $this->redirectToRoute('email_compose');
        }
        return $this->render('BackBundle:Default:modifierGarderie.html.twig', array('f' => $form->createView()));
    }


    public function deleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $equipe=$em->find(Garderies::class,$id);
        $em->remove($equipe);
        $em->flush();
        return $this->redirectToRoute('email_compose');
    }
}
