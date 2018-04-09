<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Entity\Covoiturages;
use UserBundle\Form\CovoituragesType;
use Symfony\Component\HttpFoundation\Request;

class CovoiturageController extends Controller
{
    public function ajouterAction(Request $request)
    {
        $cov= new Covoiturages();
        $form=$this->createForm(CovoituragesType::class,$cov);
        if ($form->handleRequest($request)->isValid())
        {
            $em=$this->getDoctrine()->getManager();

            $em->persist($cov);
            $em->flush();
            return $this->redirectToRoute('index');
        }


        return $this->render('FrontBundle:Default:ajouterCov.html.twig', array(
            'f'=>$form->createView()
            // ...
        ));
    }

    public function afficherAction()
    {
        $em = $this->getDoctrine()->getManager();

        $evenements = $em->getRepository("UserBundle:Covoiturages")->findAll();
        return $this->render('FrontBundle:Default:ListeCov.html.twig', array(
            // ...
            'm'=>$evenements
        ));
    }

    public function modifierAction()
    {
        return $this->render('UserBundle:Covoiturage:modifier.html.twig', array(
            // ...
        ));
    }

}
