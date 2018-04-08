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


        return $this->render('BackBundle:Default:email_compose.html.twig',array('f'=>$form->createView(),'m'=>$equipes));

    }

    public function rechercherAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        $motcle=$request->get('motcle');
        $repository=$em->getRepository('UserBundle:Garderies');
        $query=$em->createQueryBuilder()
            ->select('p')->from('UserBundle:Garderies','p')
            ->where('p.nom like :nom')
            ->setParameter('nom','%'.$motcle.'%')
            ->orderBy('p.nom','ASC')
            ->getQuery();

        $produits=$query->getResult();
//ajout
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

        return $this->render('BackBundle:Default:email_compose.html.twig',array('m'=>$produits,'f'=>$form->createView()));
    }

    public function affichageAction()
    {
        $marque=new Garderies();

        $em=$this->getDoctrine()->getManager();

        $equipes=$em->getRepository('UserBundle:Garderies')->findAll();

        return $this->render('FrontBundle:Default:care.html.twig', array(
            'm'=>$equipes));

    }
    public function plusAction($id)
    {
        $marque=new Garderies();

        $em=$this->getDoctrine()->getManager();

        $equipes=$em->getRepository('UserBundle:Garderies')->findOneBy(array('idGarderie'=>$id));

        return $this->render('FrontBundle:Default:plus.html.twig', array(
            'm'=>$equipes,'id'=>$id));

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
        $enseignant = $em->getRepository('UserBundle:Enseignants')->findBy(array('idGarderie'=>$id));
        $enfant = $em->getRepository('UserBundle:Enfants')->findBy(array('idGarderie'=>$id));
        $act = $em->getRepository('UserBundle:Activite')->findBy(array('idGarderie'=>$id));
        $etape = $em->getRepository('UserBundle:Activite')->findBy(array('idActivite'=>$act->getIdActivite()));
        $userE = $em->getRepository('UserBundle:UserEtape')->findBy(array('idEtape'=>$etape->getIdEtape()));
        foreach ($userE as $u){
            $em->remove($u);
            $em->flush();
        }
        foreach ($enseignant as $e){
            $em->remove($e);
            $em->flush();
        }
        foreach ($etape as $et){
            $em->remove($et);
            $em->flush();
        }
        foreach ($act as $a){
            $em->remove($a);
            $em->flush();
        }
        foreach ($enfant as $en){
            $em->remove($en);
            $em->flush();
        }
        $equipe=$em->find(Garderies::class,$id);
        $em->remove($equipe);
        $em->flush();
        return $this->redirectToRoute('email_compose');
    }
}
