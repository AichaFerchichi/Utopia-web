<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Entity\OffresBabysitter;
use UserBundle\Form\ALerteProfilType;
use UserBundle\Form\modifierType;
use UserBundle\Form\OffresBabysitterType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile ;
class OffresBabysitterController extends Controller
{
    public function ajoutOffresAction(Request $request)
    {


        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        if ($user=='anon.')
            return $this->redirectToRoute('fos_user_security_login');


       else {
           $profil = $em->getRepository('UserBundle:OffresBabysitter', $user)->findBy(array('idbb' => $user->getId()));

           if ($profil == null) {
               $voiture = new OffresBabysitter();
               $form = $this->createForm(OffresBabysitterType::class, $voiture);
               if ($form->handleRequest($request)->isValid()) {
                   /**
                    * @var UploadedFile $file
                    */
                   $file = $voiture->getImage();
                   $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                   $file->move($this->getParameter('image_directory'), $fileName);
                   $voiture->setImage($fileName);
                   $voiture->setIdbb($user);
                   $em = $this->getDoctrine()->getManager();
                   $em->persist($voiture);
                   $em->flush();
                   return $this->redirectToRoute('profilBB');
               }
           } else

               return $this->redirectToRoute('profilBB');

       }

        return $this->render('FrontBundle:Default:createProfile.html.twig', array('f'=>$form->createView(),'nom'=>$user->getUsername(),
            'email'=>$user->getEmail()
        ));


    }
    public function affichageAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $marque=new OffresBabysitter();

        $em=$this->getDoctrine()->getManager();

        $equipes=$em->getRepository('UserBundle:OffresBabysitter')->findBy(array('idbb' => $user->getId()));


        return $this->render('FrontBundle:Default:profilbaby.html.twig', array(
            'm'=>$equipes,'nom'=>$user->getUsername(),'email'=>$user->getEmail()));

    }
    public function deleteAction($ref1)
    {

        $em=$this->getDoctrine()->getManager();
        $voiture=$em->find(OffresBabysitter::class,$ref1);
        $em->remove($voiture);
       $em->flush();
        return $this->redirectToRoute('profil');



    }
    public function modifierAction($ref2,Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em=$this->getDoctrine()->getManager() ;
        $mark=$em->getRepository('UserBundle:OffresBabysitter')->find($ref2) ;
        $form=$this->createForm(modifierType::class,$mark) ;

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
            return $this->redirectToRoute('profilBB') ;
        }        return $this->render('FrontBundle:Default:modifierProfil.html.twig',array('f'=>$form->createView(),'nom'=>$user->getUsername(),'email'=>$user->getEmail())) ;
    }
    public function profilParentAction(){

        $em=$this->getDoctrine()->getManager();


        $query1=$em->createQueryBuilder()
            ->select('m.idOffre,m.dateProfil,u.username,u.email,m.description,m.adresse,m.sexe,m.numtel,m.experience,m.lieu_baby,m.fumeuse,m.enfant,m.conduite,m.agregation,m.dispo,m.age,m.image')->from('UserBundle:OffresBabysitter','m')
            ->join('UserBundle:User','u')->where('m.idbb = u.id')
          ->getQuery();

        $equipes=$query1->getResult();


        return $this->render('FrontBundle:Default:profilParent.html.twig', array(
            'm'=>$equipes));
    }
    public function monprofilAction($id){

        $em=$this->getDoctrine()->getManager();


        $query1=$em->createQuery("select m.dateProfil,u.username,u.email,m.description,m.adresse,m.sexe,m.numtel,m.experience,m.lieu_baby,m.fumeuse,m.enfant,
m.conduite,m.agregation,m.dispo,m.age,m.image from UserBundle:OffresBabysitter m join UserBundle:User u where  u.id=m.idbb and m.idOffre=:x")
            ->setParameter('x',$id);

        $equipes=$query1->getResult();


        return $this->render('FrontBundle:Default:profilParent2.html.twig', array(
            'm'=>$equipes));
    }


}
