<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Entity\DemandesParent;
use UserBundle\Entity\OffresBabysitter;
use UserBundle\Form\ALerteProfilType;
use UserBundle\Form\DemandesParentType;
use UserBundle\Form\modifierType;
use UserBundle\Form\OffresBabysitterType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile ;
use UserBundle\Form\RechercheFormAjax;

class OffresBabysitterController extends Controller
{
    public function ajoutOffresAction(Request $request)
    {


        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $equipes=$em->getRepository('UserBundle:OffresBabysitter')->findAll();

        foreach ($equipes as $m) {

            $m->setNote(null);
            $em->persist($m);
            $em->flush();
        }
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
                   $voiture->setDateProfil((new\DateTime('now')));
                   $em = $this->getDoctrine()->getManager();
                   $em->persist($voiture);
                   $em->flush();

                   return $this->redirectToRoute('profilBB');
               }

else{


        $request->getSession()
            ->getFlashBag()
            ->add('age', "Vous devez avoir un age entre 18 et 65 ans");

    }
}

            else

               return $this->redirectToRoute('profilBB');

       }


        return $this->render('FrontBundle:Default:ajoutProfil.html.twig', array('f'=>$form->createView(),'nom'=>$user->getUsername(),
            'email'=>$user->getEmail()
        ));


    }
    public function affichageAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em=$this->getDoctrine()->getManager();
        $equipes=$em->getRepository('UserBundle:OffresBabysitter')->findAll();

        foreach ($equipes as $m) {

            $m->setNote(null);
            $em->persist($m);
            $em->flush();
        }
        $equipes=$em->getRepository('UserBundle:OffresBabysitter')->findBy(array('idbb' => $user->getId()));
        $query2 = $em->createQuery("select m.idDemande,m.dateDebut,m.dateFin,m.heureDebut,m.heureFin,m.description,u.username from UserBundle:DemandesParent m join UserBundle:User u where m.etat=0 and u.id=m.idParent and m.idBabysitter =:x")
            ->setParameter('x', $user->getId());
        $equipes2 = $query2->getResult();
        foreach ($equipes as $equipe) {


        if($equipe->getEtat()==1)
        {
            $request->getSession()
                ->getFlashBag()
                ->add('traitement1', "Votre offre de travail a été refusée par le proprietaire,mais vous pouvez partager votre compte
                grâce à notre service de réseaux sociaux!");
        }
       elseif($equipe->getEtat()==2)
        {
            $request->getSession()
                ->getFlashBag()
                ->add('traitement2', "Votre offre de travail a été acceptée par le proprietaire,elle est déja publiée");

        }
       else {
            $request->getSession()
                ->getFlashBag()
                ->add('traitement3', "Vous offre de travail n'a pas été encore traitée par le proprietaire,merci de patientier!");
        }}
        return $this->render('FrontBundle:Default:profilBaby.html.twig', array(
            'm'=>$equipes,'email'=>$user->getEmail(),'nom'=>$user->getUsername(),'m1'=>$equipes2));

    }
    public function deleteAction($ref1,Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em=$this->getDoctrine()->getManager();
        $equipes=$em->getRepository('UserBundle:OffresBabysitter')->findAll();

        foreach ($equipes as $m) {

            $m->setNote(null);
            $em->persist($m);
            $em->flush();
        }
        $voiture=$em->find(OffresBabysitter::class,$ref1);
        $em->remove($voiture);
       $em->flush();
        $equipes=$em->getRepository('UserBundle:OffresBabysitter')->findOneBy(array('idbb' => $user->getId()));

        if($equipes==null){

            $request->getSession()
                ->getFlashBag()
                ->add('supp', "Votre porfil a été supprimé,merci de nous revisiter");

        }
        return $this->redirectToRoute('kitchen');



    }
    public function modifierAction($ref2,Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em=$this->getDoctrine()->getManager() ;
        $equipes=$em->getRepository('UserBundle:OffresBabysitter')->findAll();

        foreach ($equipes as $m) {

            $m->setNote(null);
            $em->persist($m);
            $em->flush();
        }
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
    /*
    public function profilParentAction(){

        $em=$this->getDoctrine()->getManager();


        $query1=$em->createQueryBuilder()
            ->select('m.idOffre,m.dateProfil,u.username,u.email,m.description,m.adresse,m.sexe,m.numtel,m.experience,m.lieu_baby,m.fumeuse,m.enfant,m.conduite,m.agregation,m.dispo,m.age,m.image')->from('UserBundle:OffresBabysitter','m')
            ->join('UserBundle:User','u')->where('m.idbb = u.id and m.etat=2')
          ->getQuery();

        $equipes=$query1->getResult();


        return $this->render('FrontBundle:Default:profilReserv.html.twig', array(
            'm'=>$equipes));
    }*/
    public function monprofilAction($id){
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $equipes=$em->getRepository('UserBundle:OffresBabysitter')->findAll();

        foreach ($equipes as $m) {

            $m->setNote(null);
            $em->persist($m);
            $em->flush();
        }
        if ($user=='anon.')
            return $this->redirectToRoute('fos_user_security_login');

        else {
            $voiture = new DemandesParent();
            $form = $this->createForm(DemandesParentType::class, $voiture);
            $em = $this->getDoctrine()->getManager();
            $query1 = $em->createQuery("select u.id,m.dateProfil,u.username,u.email,m.description,m.adresse,m.sexe,m.numtel,m.experience,m.lieu_baby,m.fumeuse,m.enfant,
            m.conduite,m.agregation,m.dispo,m.age,m.image from UserBundle:OffresBabysitter m join UserBundle:User u where  u.id=m.idbb and m.idOffre=:x")
                ->setParameter('x', $id);

            $equipes = $query1->getResult();



        }
          return $this->render('FrontBundle:Default:profilParent2.html.twig', array(
            'm'=>$equipes,'f'=>$form->createView()));
    }
public function profilReservAction(Request $request){
    $user = $this->get('security.token_storage')->getToken()->getUser();
    $em = $this->getDoctrine()->getManager();
    $equipes=$em->getRepository('UserBundle:OffresBabysitter')->findAll();

    foreach ($equipes as $m) {

        $m->setNote(null);
        $em->persist($m);
        $em->flush();
    }
    if ($user=='anon.')
        return $this->redirectToRoute('fos_user_security_login');


    else {
        $recherche = $em->getRepository('UserBundle:DemandesParent')->findBy(array('idParent' => $user->getId()));
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQueryBuilder()
            ->delete('UserBundle:DemandesParent', 'p')
            ->where('p.dateFin < CURRENT_DATE()')
            ->getQuery();

        $query->execute();
        if ($recherche == null) {
            $request->getSession()
                ->getFlashBag()
                ->add('danger', "Vous n'avez pas de reservation");
        }

        $em = $this->getDoctrine()->getManager();


        $query1 = $em->createQueryBuilder()
            ->select('m.idOffre,m.dateProfil,u.username,u.email,m.description,m.adresse,m.sexe,m.numtel,m.experience,m.lieu_baby,m.fumeuse,m.enfant,m.conduite,m.agregation,m.dispo,m.age,m.image')->from('UserBundle:OffresBabysitter', 'm')
            ->join('UserBundle:User', 'u')->where('m.idbb = u.id')
            ->getQuery();

        $equipes = $query1->getResult();
        $query2 = $em->createQuery("select m.idDemande,m.dateDebut,m.dateFin,m.heureDebut,m.heureFin,m.description,u.username from UserBundle:DemandesParent m join UserBundle:User u where u.id=m.idBabysitter and m.idParent =:x")
            ->setParameter('x', $user->getId());

        $equipes2 = $query2->getResult();

        return $this->redirectToRoute('profilReserv');

    }

    return $this->render('FrontBundle:Default:profilReserv.html.twig', array(
        'm'=>$equipes,'m1'=>$equipes2));}



public function echecAction(){


    return $this->render('FrontBundle:Default:echec.html.twig');}

    public function echecDateAction(){


        return $this->render('FrontBundle:Default:echecDate.html.twig');}
    public function rechercheserieDQLAction(Request $request)
    {  $em=$this->getDoctrine()->getManager();
        $equipes=$em->getRepository('UserBundle:OffresBabysitter')->findAll();

        foreach ($equipes as $m) {

            $m->setNote(null);
            $em->persist($m);
            $em->flush();
        }
        $marks=$em->getRepository('UserBundle:OffresBabysitter')->findAll();
        $marque = new OffresBabysitter();
        $form=$this->createForm(RechercheFormAjax::class,$marque);
        $form->handleRequest($request);
        if ($request->isXmlHttpRequest())
        { $serializer = new Serializer(array(new ObjectNormalizer()));
            $queryE = $em->createQueryBuilder()
                ->select('p')->from('UserBundle:OffresBabysitter', 'p')
                ->where('p.adresse like :adresse and p.etat=1')
                ->setParameter('adresse', '%'.$request->get('adresse').'%')
                ->getQuery();

            $marks=$queryE->getResult();
            $data = $serializer->normalize($marks);
            return new JsonResponse($data);
        }
        return $this->render('FrontBundle:Default:tri.html.twig',array('m'=>$marks,'f'=>$form->createView()));


    }
    public function rechercherProfilAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();
        $equipes=$em->getRepository('UserBundle:OffresBabysitter')->findAll();

        foreach ($equipes as $m) {

            $m->setNote(null);
            $em->persist($m);
            $em->flush();
        }
        $motcle = $request->get('adresse');
        $query = $em->createQueryBuilder()
            ->select('m.idOffre,m.dateProfil,u.username,u.email,m.description,m.adresse,m.sexe,m.numtel,m.experience,m.lieu_baby,m.fumeuse,m.enfant,m.conduite,m.agregation,m.dispo,m.age,m.image')->from('UserBundle:OffresBabysitter', 'm')
            ->join('UserBundle:User', 'u')
            ->where('m.adresse like :adresse and m.etat=2 and m.idbb = u.id')
            ->setParameter('adresse', '%' . $motcle . '%')
            ->orderBy('m.adresse', 'ASC')
            ->getQuery();

        $produits = $query->getResult();

        $query2 = $em->createQuery("select m.etat,m.idDemande,m.dateDebut,m.dateFin,m.heureDebut,m.heureFin,m.description,u.username from UserBundle:DemandesParent m join UserBundle:User u where u.id=m.idBabysitter and m.idParent =:x")
            ->setParameter('x', $user->getId());

        $equipes2 = $query2->getResult();
        return $this->render('FrontBundle:Default:profilReserv.html.twig', array('m' => $produits,'m1'=>$equipes2));
    }
    public function aprouverProfilAction(){
        $em=$this->getDoctrine()->getManager();
        $equipes=$em->getRepository('UserBundle:OffresBabysitter')->findAll();

        foreach ($equipes as $m) {

            $m->setNote(null);
            $em->persist($m);
            $em->flush();
        }
        $query = $em->createQueryBuilder()
            ->select('m.idOffre,m.etat,m.dateProfil,u.username,m.description,m.adresse,m.sexe,m.numtel,m.experience,m.lieu_baby,m.fumeuse,m.enfant,m.conduite,m.agregation,m.dispo,m.age,m.image')->from('UserBundle:OffresBabysitter', 'm')
            ->join('UserBundle:User', 'u')
            ->where('m.idbb = u.id')
            ->orderBy('m.adresse', 'ASC')
            ->getQuery();

        $produits = $query->getResult();



        return $this->render('BackBundle:Default:approuverProfils.html.twig', array('m' => $produits));}
       public function approuverProfilAction($idOffre,Request $request){
           $user = $this->get('security.token_storage')->getToken()->getUser();
           $em=$this->getDoctrine()->getManager() ;
           $equipes=$em->getRepository('UserBundle:OffresBabysitter')->findAll();

           foreach ($equipes as $m) {

               $m->setNote(null);
               $em->persist($m);
               $em->flush();
           }
           $mark=$em->getRepository('UserBundle:OffresBabysitter')->find($idOffre) ;
           if($mark->getEtat()==0) {
               $request->getSession()
                   ->getFlashBag()
                   ->add('success', "Cette demande a été accepter");
           }

               if(($mark->getNbApp()!=0)&&($mark->getEtat()==2)||($mark->getNbApp()!=0)&&($mark->getEtat()==1))
               {
                   $request->getSession()
                       ->getFlashBag()
                       ->add('traite1', "Vous avez deja traité cette demande!");
                   return $this->redirectToRoute('gestionProfils') ;

               }
           else{
               $mark->setEtat(2) ;
               $mark->setNbApp(1);
               $em->persist($mark) ;
               $em->flush() ;
               return $this->redirectToRoute('gestionProfils') ;
           }

       }


       public function refuserProfilAction($idOffre,Request $request){
           $user = $this->get('security.token_storage')->getToken()->getUser();
           $em=$this->getDoctrine()->getManager() ;
           $equipes=$em->getRepository('UserBundle:OffresBabysitter')->findAll();

           foreach ($equipes as $m) {

               $m->setNote(null);
               $em->persist($m);
               $em->flush();
           }
           $mark=$em->getRepository('UserBundle:OffresBabysitter')->find($idOffre) ;
           if($mark->getEtat()==0) {
               $request->getSession()
                   ->getFlashBag()
                   ->add('danger', "Cette demande a été refusé");
           }
           if(($mark->getNbApp()!=0)&&($mark->getEtat()==1)||($mark->getNbApp()!=0)&&($mark->getEtat()==2))
           {
               $request->getSession()
                   ->getFlashBag()
                   ->add('traite2', "Vous avez deja traité cette demande!");
               return $this->redirectToRoute('gestionProfils') ;

           }
           else{
               $mark->setEtat(1) ;
               $mark->setNbApp(1);
               $em->persist($mark) ;
               $em->flush() ;
               return $this->redirectToRoute('gestionProfils') ;
           }}

}