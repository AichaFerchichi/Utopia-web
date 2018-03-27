<?php

namespace UserBundle\Controller;


use UserBundle\Form\EnseignantsType;
use UserBundle\Form\RechercheForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Enseignants;


class EnseignantsController extends Controller
{
    public function indexAction()
    {
        return $this->render('BackBundle:Default:email_read.html.twig');
    }
    public function ajoutAction(Request $request)
    {
        $joueur= new Enseignants();


        $form=$this->createForm(EnseignantsType::class,$joueur);
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
            return $this->redirectToRoute('email_read');

        }
        $em=$this->getDoctrine()->getManager();
        $equipes=$em->getRepository('UserBundle:Enseignants')->findAll();


        return $this->render('BackBundle:Default:email_read.html.twig',array('f'=>$form->createView(),'m'=>$equipes));

    }

    public function rechercherAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        $motcle=$request->get('motcle');
        $repository=$em->getRepository('UserBundle:Enseignants');
        $query=$em->createQueryBuilder()
            ->select('p')->from('UserBundle:Enseignants','p')
            ->where('p.nom like :nom')
            ->setParameter('nom','%'.$motcle.'%')
            ->orderBy('p.nom','ASC')
            ->getQuery();

        $produits=$query->getResult();
//ajout
        $joueur= new Enseignants();


        $form=$this->createForm(EnseignantsType::class,$joueur);
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
            return $this->redirectToRoute('email_read');

        }

        return $this->render('BackBundle:Default:email_read.html.twig',array('m'=>$produits,'f'=>$form->createView()));
    }

    public function affichageAction()
    {
        $marque=new Enseignants();

        $em=$this->getDoctrine()->getManager();

        $equipes=$em->getRepository('UserBundle:Enseignants')->findAll();

        return $this->render('BackBundle:Default:email_read.html.twig', array(
            'm'=>$equipes));

    }
    public function modifierAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $mark = $em->getRepository('UserBundle:Enseignants')->find($id);
        $form = $this->createForm(EnseignantsType::class, $mark);
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
            return $this->redirectToRoute('email_read');
        }
        return $this->render('BackBundle:Default:modifierEnseignant.html.twig', array('f' => $form->createView()));
    }
    public function enseignantsAction($id)
    {
        $marque=new Enseignants();

        $em=$this->getDoctrine()->getManager();

        $equipes=$em->getRepository('UserBundle:Enseignants')->findBy(array('idGarderie'=>$id));

        return $this->render('FrontBundle:Default:enseignants.html.twig', array(
            'm'=>$equipes,'id'=>$id));

    }

    public function deleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $equipe=$em->find(Enseignants::class,$id);
        $em->remove($equipe);
        $em->flush();
        return $this->redirectToRoute('email_read');
    }
}
