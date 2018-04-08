<?php

namespace UserBundle\Controller;


use UserBundle\Entity\Enfants;
use UserBundle\Form\EnfantsType;

use UserBundle\Form\InscriptionType;
use UserBundle\Form\RechercheForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Enseignants;


class EnfantsController extends Controller
{
    public function indexAction()
    {
        return $this->render('BackBundle:Default:email_read2.html.twig');
    }
    public function ajoutAction(Request $request)
    {
        $joueur= new Enfants();


        $form=$this->createForm(EnfantsType::class,$joueur);
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
            return $this->redirectToRoute('email_read2');

        }
        $em=$this->getDoctrine()->getManager();
        $equipes=$em->getRepository('UserBundle:Enfants')->findAll();


        return $this->render('BackBundle:Default:email_read2.html.twig',array('f'=>$form->createView(),'m'=>$equipes));

    }
    public function inscrireAction(Request $request,$id)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        if ($user=='anon.')
            return $this->redirectToRoute('fos_user_security_login');
        else {

            $joueur = new Enfants();

            $equipes=$em->getRepository('UserBundle:Garderies')->findOneBy(array('idGarderie'=>$id));
            $form = $this->createForm(InscriptionType::class, $joueur);
            if ($form->handleRequest($request)->isValid()) {
                /**
                 * @var UploadedFile $file
                 */
                $file = $joueur->getImage();
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($this->getParameter('image_directory'), $fileName);
                $joueur->setImage($fileName);
                $joueur->setIdParent($user);
                $joueur->setIdGarderie($equipes);
                $em = $this->getDoctrine()->getManager();

                $em->persist($joueur);
                $em->flush();
                $equip=$em->getRepository('UserBundle:Enfants')->findAll();
                foreach($equip as $e){
                    $enfant=$e;
                }
                //return $this->redirectToRoute('affiche');
                return $this->redirectToRoute('pdf',array('idG'=>$equipes->getIdGarderie(),'idE'=>$enfant->getIdEnfant()));

            }


        }
        return $this->render('FrontBundle:Default:inscriEnfant.html.twig',array('f'=>$form->createView(),'id'=>$id));

    }

    public function rechercherAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        $motcle=$request->get('motcle');
        $repository=$em->getRepository('UserBundle:Enfants');
        $query=$em->createQueryBuilder()
            ->select('p')->from('UserBundle:Enfants','p')
            ->where('p.nomEnfant like :nom')
            ->setParameter('nom','%'.$motcle.'%')
            ->orderBy('p.nomEnfant','ASC')
            ->getQuery();

        $produits=$query->getResult();
//ajout
        $joueur= new Enfants();


        $form=$this->createForm(EnfantsType::class,$joueur);
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
            return $this->redirectToRoute('email_read2');

        }

        return $this->render('BackBundle:Default:email_read2.html.twig',array('m'=>$produits,'f'=>$form->createView()));
    }

    public function affichageAction()
    {
        $marque=new Enfants();

        $em=$this->getDoctrine()->getManager();

        $equipes=$em->getRepository('UserBundle:Enfants')->findAll();

        return $this->render('BackBundle:Default:email_read2.html.twig', array(
            'm'=>$equipes));

    }
    public function modifierAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $mark = $em->getRepository('UserBundle:Enfants')->find($id);
        $form = $this->createForm(EnfantsType::class, $mark);
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
            return $this->redirectToRoute('email_read2');
        }
        return $this->render('BackBundle:Default:modifierEnfant.html.twig', array('f' => $form->createView()));
    }


    public function deleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $equipe=$em->find(Enfants::class,$id);
        $em->remove($equipe);
        $em->flush();
        return $this->redirectToRoute('email_read2');
    }
}
