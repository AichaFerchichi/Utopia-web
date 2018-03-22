<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\OffresBabysitter;
use UserBundle\Form\OffresBabysitterType;

class OffresBabysitterController extends Controller
{
    public function gestionOffresAction(Request $request)
    {

        $voiture= new OffresBabysitter();
        $form=$this->createForm(OffresBabysitterType::class,$voiture);
        if ($form->handleRequest($request)->isValid())
        {
            $em=$this->getDoctrine()->getManager();

            $em->persist($voiture);
            $em->flush();
            return $this->redirectToRoute('profil');
        }


        return $this->render('FrontBundle:Default:createProfile.html.twig', array('f'=>$form->createView()
        ));


    }
}
