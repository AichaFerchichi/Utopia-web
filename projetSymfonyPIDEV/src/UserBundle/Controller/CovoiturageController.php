<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Entity\Covoiturages;
use UserBundle\Entity\Reservations;
use UserBundle\Form\CovoituragesType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Form\ReservationsType;


class CovoiturageController extends Controller
{
    public function ajouterAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if ($user == 'anon.')
            return $this->redirectToRoute('fos_user_security_login');


        $cov = new Covoiturages();
        $form = $this->createForm(CovoituragesType::class, $cov);
        if ($form->handleRequest($request)->isValid()) {

            $cov->setIdUser($user);
            $em = $this->getDoctrine()->getManager();

            $em->persist($cov);
            $em->flush();
            // return  new Response("Votre Covoiturage a été ajouter avec succés");
            return $this->redirectToRoute('ListeCov');

        }


        return $this->render('FrontBundle:Default:ajouterCov.html.twig', array(
            'f' => $form->createView()
            // ...
        ));
    }

    public function afficherAction()
    {

        $em = $this->getDoctrine()->getManager();

        $evenements = $em->getRepository("UserBundle:Covoiturages")->findAll();
        return $this->render('FrontBundle:Default:ListeCov.html.twig', array(
            // ...
            'm' => $evenements
        ));
    }

    public function modifierCovAction($id1, Request $request)
    {
        //$user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $mark = $em->getRepository('UserBundle:Covoiturages')->find($id1);
        $form = $this->createForm(CovoituragesType::class, $mark);

        if ($form->handleRequest($request)->isValid()) {
            /**
             * @var UploadedFile $file
             */
            $em->persist($mark);
            $em->flush();
            return $this->redirectToRoute('ListeCov');

        }
        return $this->render('UserBundle:Covoiturage:modifier.html.twig', array(
            'f' => $form->createView()
            // ...
        ));
    }

    public function afficherCAction()
    {

        $user = $this->get('security.token_storage')->getToken()->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $evenements = $em->getRepository("UserBundle:Covoiturages")->findBy(array('idUser' => $user));
        return $this->render('FrontBundle:Default:gestionCov.html.twig', array(

            // ...
            'm' => $evenements
        ));
    }

    public function supprimerCovAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $voiture = $em->getRepository('UserBundle:Covoiturages')->find($id);
       // var_dump($voiture);
        /*if (!$voiture) {
             throw $this->createNotFoundException('No livre found for id '.$id);
         }*/
        $em->remove($voiture);
        $em->flush();
        return $this->redirectToRoute('ListeCov');

    }

    public function ReserverAction($id,Request $request)
    {

        $user = $this->get('security.token_storage')->getToken()->getUser();
        if ($user == 'anon.')
            return $this->redirectToRoute('fos_user_security_login');

        $em = $this->getDoctrine()->getManager();
        $evenements = $em->getRepository("UserBundle:Covoiturages")->findBy(array('id' => $id));
       $eve= $em->getRepository("UserBundle:Covoiturages")->find($id);


        $res = new Reservations();
        $form = $this->createForm(ReservationsType::class,$res);
        if ($form->handleRequest($request)->isValid()) {
           // var_dump($eve);
            $res->setIdUser($user);
            $res->setIdc($eve);
            $em1 = $this->getDoctrine()->getManager();
            $em1->persist($res);
            $em1->flush();

        }
            return $this->render('FrontBundle:Default:gestionReservation.html.twig', array(
                // ...
                'r' => $evenements, 'f' => $form->createView()
            ));

        }

    public function afficherRAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $evenements = $em->getRepository("UserBundle:Covoiturages")->findBy(array('id' => $id));
        return $this->render('FrontBundle:Default:gestionReservation.html.twig', array(

            // ...
            'm' => $evenements
        ));
    }
    public function modifierRAction($id,Request $request)
    {

        $user = $this->get('security.token_storage')->getToken()->getUser();
        if ($user == 'anon.')
            return $this->redirectToRoute('fos_user_security_login');

        $em = $this->getDoctrine()->getManager();
        $evenements = $em->getRepository("UserBundle:Covoiturages")->findBy(array('id' => $id));
        $em = $this->getDoctrine()->getManager();
        $mark = $em->getRepository('UserBundle:Covoiturages')->find($id);
        $form = $this->createForm(CovoituragesType::class, $mark);

        if ($form->handleRequest($request)->isValid()) {

            $em->persist($mark);
            $em->flush();
            return $this->redirectToRoute('ListeCov');

        }

        return $this->render('FrontBundle:Default:gestionReservation.html.twig', array(
            // ...
            'r' => $evenements, 'f' => $form->createView()
        ));

    }
}
