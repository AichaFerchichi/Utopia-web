<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\MoyensDeTransport;
use UserBundle\Form\RechercheMoyen;

class MoyenTransportController extends Controller
{
    public function ajouterAction(Request $request)
    {

        $moy=new MoyensDeTransport();
        if ($request->isMethod('POST')){
            $moy->setType($request->get('type'));
            $moy->setImmatriculation($request->get('immatriculation'));
            $moy->setNombreDePlace($request->get('nombre_de_place'));
            $em=$this->getDoctrine()->getManager();
            $em->persist($moy);
            $em->flush();
        }

        return $this->render('BackBundle:Default:AjoutMoyen.html.twig', array(
            // ...
        ));
    }

    public function supprimerAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $voiture= $em->getRepository("UserBundle:MoyensDeTransport")->find($id);
        $em->remove($voiture);
        $em->flush();
        return $this->redirectToRoute("ListeMoyen");

    }

    public function ModifierAction(Request $request)
    {

        $em=$this->getDoctrine()->getManager();
        $moy= $em->getRepository("UserBundle:MoyensDeTransport")->find($request->get('id'));

        if ($request->isMethod('POST')){
            $moy->setType($request->get('type'));
            $moy->setImmatriculation($request->get('immatriculation'));
            $moy->setNombreDePlace($request->get('nombre_de_place'));
            $em=$this->getDoctrine()->getManager();
            $em->persist($moy);
            $em->flush();
        }
        return $this->render('UserBundle:MoyenTransport:modifier.html.twig', array(
            'm'=>$moy
            // ...
        ));
    }
    public function afficherAction()
    {

        $em = $this->getDoctrine()->getManager();

        $evenements = $em->getRepository("UserBundle:MoyensDeTransport")->findAll();


        return $this->render('BackBundle:Default:ListeMoyen.html.twig', array(
            'e' => $evenements
            // ...
        ));

    }
    public function rechercherAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $marks=$em->getRepository('UserBundle:MoyensDeTransport')->findAll();
        $marque=new MoyensDeTransport();
        $form=$this->createForm(RechercheMoyen::class,$marque);
        if($form->handleRequest($request)->isValid()){
            $em=$this->getDoctrine()->getManager();
            $marks=$em->getRepository('UserBundle:MoyensDeTransport')->find($marque->getImmatriculation());
        }
        return $this->render('BackBundle:Default:ListeMoyen.html.twig', array(
            'f'=>$form->createView(),'m'=>$marks
        ));
    }


}

