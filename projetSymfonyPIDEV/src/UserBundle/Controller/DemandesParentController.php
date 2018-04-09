<?php

namespace UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\DemandesParent;
use UserBundle\Form\DemandesParentType;

class DemandesParentController extends Controller
{
    public function reserverAction(Request $request,$idbaby)
    {

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $equipes=$em->getRepository('UserBundle:OffresBabysitter')->findAll();

        foreach ($equipes as $m) {

            $m->setNote(null);
            $em->persist($m);
            $em->flush();
        }
        $demande=$em->getRepository('UserBundle:DemandesParent')->findBy(array('idBabysitter' => $idbaby,'idParent' => $user->getId()));
        $voiture = new DemandesParent();
        $form = $this->createForm(DemandesParentType::class, $voiture);
        $em = $this->getDoctrine()->getManager();

        $baby=$em->getRepository('UserBundle:User')->find($idbaby);
        $i=0;
        if ($user=='anon.')
            return $this->redirectToRoute('fos_user_security_login');



        if ($form->handleRequest($request)->isValid()) {
            $mark=$em->getRepository('UserBundle:DemandesParent')->findBy(array('idParent' => $user->getId())) ;
            if($demande!=null) {
                $request->getSession()
                    ->getFlashBag()
                    ->add('danger', "Vous avez deja reserver ce(tte) babysitter");
            }


            elseif ($voiture->getDateDebut() > (new \DateTime('now')) && ($voiture->getDateFin() > (new \DateTime('now')))
                        && ($voiture->getDateFin() > $voiture->getDateDebut()) &&
                        ($voiture->getHeureFin() > $voiture->getHeureDebut())) {

                        if ($mark != null) {
                            foreach ($mark as $m) {
                                if ((($m->getDateDebut() > $voiture->getDateFin()) || (($m->getDateFin() < $voiture->getDateDebut())))) {
                                    $mark2 = true;
                                    break;
                                } else {
                                    $mark2 = false;
                                    break;
                                }
                            }
                            if ($mark2 != true) {
                                return $this->redirectToRoute('echecDate');
                            } else {
                                $voiture->setIdParent($user);
                                $voiture->setEtat(0);
                                $voiture->setIdBabysitter($baby);
                                $em->persist($voiture);
                                $em->flush();
                                return $this->redirectToRoute('profilParent');
                            }

                        } else {
                            $voiture->setIdParent($user);
                            $voiture->setEtat(0);

                            $voiture->setIdBabysitter($baby);
                            $em->persist($voiture);
                            $em->flush();
                            return $this->redirectToRoute('profilParent');
                        }

                    }
                    else {
                        return $this->redirectToRoute('echec');
                    }}
        return $this->render('FrontBundle:Default:reservation.html.twig', array(
            'f' => $form->createView(), 'nom' => $baby->getUsername()));
    }
    public function preferenceAction(Request $request)
    {
        if ($request->getMethod() == "POST") {
            $a = $request->get('adresse');
            $b = $request->get('age');
            $c = $request->get('dispo');
            $d = $request->get('experience');
            $e = $request->get('lieu');
            $em = $this->getDoctrine()->getManager();
            if (($d != "2") && ($e != "2")) {
                $query1 = $em->createQueryBuilder()
                    ->select('p')->from('UserBundle:OffresBabysitter', 'p')
                    ->where('p.adresse like :adresse and p.age =:age and p.dispo like :dispo and p.experience like :exp and p.lieu_baby like :lieu')
                    ->setParameters(array('adresse' => '%' . $a . '%', 'age' => $b,
                        'dispo' => '%' . $c . '%', 'exp' => '%' . "Sans experience" . '%', 'lieu' => '%' . "Pas de preferences" . '%'))->getQuery();
                $produits1 = $query1->getResult();
                if($produits1!=null){
                foreach ($produits1 as $m) {


                    $m->setNote(100);
                    $em->persist($m);
                    $em->flush();

                }}
            } elseif (($d != "1") && ($e != "2")) {

                $query1 = $em->createQueryBuilder()
                    ->select('p')->from('UserBundle:OffresBabysitter', 'p')
                    ->where('p.adresse like :adresse and p.age =:age and p.dispo like :dispo and p.experience not like :exp and p.lieu_baby like :lieu')
                    ->setParameters(array('adresse' => '%' . $a . '%', 'age' => $b,
                        'dispo' => '%' . $c . '%', 'exp' => '%' . 'Sans experience' . '%', 'lieu' => '%' . 'Pas de preferences' . '%'))->getQuery();
                $produits1 = $query1->getResult();
                if($produits1!=null){

                foreach ($produits1 as $m) {


                    $m->setNote(100);
                    $em->persist($m);
                    $em->flush();

                }}
            } elseif (($d != "2") && ($e != "1")) {
                $query1 = $em->createQueryBuilder()
                    ->select('p')->from('UserBundle:OffresBabysitter', 'p')
                    ->where('p.adresse like :adresse and p.age =:age and p.dispo like :dispo and p.experience like :exp and p.lieu_baby not like :lieu')
                    ->setParameters(array('adresse' => '%' . $a . '%', 'age' => $b,
                        'dispo' => '%' . $c . '%', 'exp' => '%' . 'Sans experience' . '%', 'lieu' => '%' . 'Pas de preferences' . '%'))->getQuery();
                $produits1 = $query1->getResult();
                if($produits1!=null){

                foreach ($produits1 as $m) {


                    $m->setNote(100);
                    $em->persist($m);
                    $em->flush();

                }}
            } else {
                $query1 = $em->createQueryBuilder()
                    ->select('p')->from('UserBundle:OffresBabysitter', 'p')
                    ->where('p.adresse like :adresse and p.age =:age and p.dispo like :dispo and p.experience not like :exp and p.lieu_baby not like :lieu')
                    ->setParameters(array('adresse' => '%' . $a . '%', 'age' => $b,
                        'dispo' => '%' . $c . '%', 'exp' => '%' . 'Sans experience' . '%', 'lieu' => '%' . 'Pas de preferences' . '%'))->getQuery();
                $produits1 = $query1->getResult();

                  if($produits1!=null){
                      foreach ($produits1 as $m) {


                          $m->setNote(100);
                          $em->persist($m);
                          $em->flush();

                      }
                  }
            }
            if($produits1==null) {
                $queryA = $em->createQueryBuilder()
                    ->select('p')->from('UserBundle:OffresBabysitter', 'p')
                    ->where('p.adresse like :adresse')
                    ->setParameter('adresse', '%' . $a . '%')
                    ->getQuery();

                $produitsA = $queryA->getResult();
                foreach ($produitsA as $m) {
                    $noteA = $m->getNote();
                    $m->setNote($noteA + 20);
                    $em->persist($m);
                    $em->flush();
                }
                $queryB = $em->createQueryBuilder()
                    ->select('p')->from('UserBundle:OffresBabysitter', 'p')
                    ->where('p.age =:age')
                    ->setParameter('age', $b)
                    ->getQuery();

                $produitsB = $queryB->getResult();
                foreach ($produitsB as $m) {
                    $noteB = $m->getNote();
                    $m->setNote($noteB + 20);
                    $em->persist($m);
                    $em->flush();
                }
                $queryC = $em->createQueryBuilder()
                    ->select('p')->from('UserBundle:OffresBabysitter', 'p')
                    ->where('p.dispo like :dispo')
                    ->setParameter('dispo', '%' . $c . '%')
                    ->getQuery();

                $produitsC = $queryC->getResult();
                foreach ($produitsC as $m) {
                    $noteC = $m->getNote();
                    $m->setNote($noteC + 20);
                    $em->persist($m);
                    $em->flush();
                }
                if ($d != "2") {
                    $queryD = $em->createQueryBuilder()
                        ->select('p')->from('UserBundle:OffresBabysitter', 'p')
                        ->where('p.experience like :exp')
                        ->setParameter('exp', '%' . 'Sans experience' . '%')
                        ->getQuery();
                }
                if ($d != "1") {
                    $queryD = $em->createQueryBuilder()
                        ->select('p')->from('UserBundle:OffresBabysitter', 'p')
                        ->where('p.experience not like :exp')
                        ->setParameter('exp', '%' . 'Sans experience' . '%')
                        ->getQuery();
                }
                $produitsD = $queryD->getResult();

                foreach ($produitsD as $m) {
                    $noteD = $m->getNote();
                    $m->setNote($noteD + 20);
                    $em->persist($m);
                    $em->flush();
                }
                if ($e != "2") {
                    $queryE = $em->createQueryBuilder()
                        ->select('p')->from('UserBundle:OffresBabysitter', 'p')
                        ->where('p.lieu_baby like :lieu')
                        ->setParameter('lieu', '%' . 'Pas de preferences' . '%')
                        ->getQuery();
                }
                if ($e != "1") {
                    $queryE = $em->createQueryBuilder()
                        ->select('p')->from('UserBundle:OffresBabysitter', 'p')
                        ->where('p.lieu_baby not like :lieu')
                        ->setParameter('lieu', '%' . 'Pas de preferences' . '%')
                        ->getQuery();
                }

                $produitsE = $queryE->getResult();
                foreach ($produitsE as $m) {
                    $noteE = $m->getNote();
                    $m->setNote($noteE + 20);
                    $em->persist($m);
                    $em->flush();
                }


            }
                    }
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $query2 = $em->createQuery("select m.etat,m.idDemande,m.dateDebut,m.dateFin,m.heureDebut,m.heureFin,m.description,u.username from UserBundle:DemandesParent m join UserBundle:User u where m.etat=0 and u.id=m.idParent and m.idBabysitter =:x")
            ->setParameter('x', $user->getId());
        $equipes2 = $query2->getResult();


        $query1=$em->createQueryBuilder()
            ->select('p.idOffre,p.note,p.dateProfil,u.username,u.email,p.description,p.adresse,p.sexe,p.numtel,p.experience,p.lieu_baby,p.fumeuse,p.enfant,p.conduite,p.agregation,p.dispo,p.age,p.image')->from('UserBundle:OffresBabysitter','p')
            ->join('UserBundle:User','u')->where('p.idbb = u.id and p.note is not null')
            ->orderBy('p.note','DESC')->getQuery();

        $equipes=$query1->getResult();





        return $this->render('FrontBundle:Default:preference.html.twig', array(
            'm'=>$equipes,'m1'=>$equipes2));
    }
    public function profilParentAAction(){
$em=$this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();

        if ($user=='anon.')
            return $this->redirectToRoute('fos_user_security_login');
        $equipes=$em->getRepository('UserBundle:OffresBabysitter')->findAll();

        foreach ($equipes as $m) {

            $m->setNote(null);
            $em->persist($m);
            $em->flush();
        }
$query1=$em->createQueryBuilder()
->select('m.idOffre,m.dateProfil,u.username,u.email,m.description,m.adresse,m.sexe,m.numtel,m.experience,m.lieu_baby,m.fumeuse,m.enfant,m.conduite,m.agregation,m.dispo,m.age,m.image')->from('UserBundle:OffresBabysitter','m')
->join('UserBundle:User','u')->where('m.idbb = u.id and m.etat=2')
->getQuery();

$equipes=$query1->getResult();
        $query2 = $em->createQuery("select m.etat,m.idDemande,m.dateDebut,m.dateFin,m.heureDebut,m.heureFin,m.description,u.username from UserBundle:DemandesParent m join UserBundle:User u where u.id=m.idBabysitter and m.idParent =:x")
            ->setParameter('x', $user->getId());

        $equipes2 = $query2->getResult();



return $this->render('FrontBundle:Default:profilReserv.html.twig', array(
'm'=>$equipes,'m1'=>$equipes2));
}
public function rechercherReservAction(Request $request){
    $em=$this->getDoctrine()->getManager();
    $equipes=$em->getRepository('UserBundle:OffresBabysitter')->findAll();

    foreach ($equipes as $m) {

        $m->setNote(null);
        $em->persist($m);
        $em->flush();
    }
    $query=$em->createQueryBuilder()
        ->delete('UserBundle:DemandesParent','p')
        ->where('p.dateFin < CURRENT_DATE()')
        ->getQuery();

    $query->execute();
    $em=$this->getDoctrine()->getManager();
    $motcle=$request->get('adresse');
    $query=$em->createQueryBuilder()
        ->select('m.etat,m.idDemande,m.dateDebut,m.dateFin,m.heureDebut,m.heureFin,m.description,u.username')->from('UserBundle:DemandesParent','m')
        ->join('UserBundle:User','u')
        ->where('u.username like :username and m.idParent=u.id')
        ->setParameters(array('username'=>'%'.$motcle.'%'))
        ->getQuery();

    $produits=$query->getResult();
    $em = $this->getDoctrine()->getManager();


    $query1 = $em->createQueryBuilder()
        ->select('m.idOffre,m.dateProfil,u.username,u.email,m.description,m.adresse,m.sexe,m.numtel,m.experience,m.lieu_baby,m.fumeuse,m.enfant,m.conduite,m.agregation,m.dispo,m.age,m.image')->from('UserBundle:OffresBabysitter', 'm')
        ->join('UserBundle:User', 'u')->where('m.idbb = u.id')
        ->getQuery();

    $equipes = $query1->getResult();


    return $this->render('FrontBundle:Default:rechercheProfil.html.twig',array('m1'=>$produits,'m'=>$equipes));
}
    public function rechercherProfilAction(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em=$this->getDoctrine()->getManager();
        $equipes=$em->getRepository('UserBundle:OffresBabysitter')->findAll();

        foreach ($equipes as $m) {

            $m->setNote(null);
            $em->persist($m);
            $em->flush();
        }
        $motcle=$request->get('adresse');
        $query=$em->createQueryBuilder()
            ->select('m.idOffre,m.dateProfil,u.username,u.email,m.description,m.adresse,m.sexe,m.numtel,m.experience,m.lieu_baby,m.fumeuse,m.enfant,m.conduite,m.agregation,m.dispo,m.age,m.image')->from('UserBundle:OffresBabysitter','m')
            ->join('UserBundle:User','u')
            ->where('m.adresse like :adresse and m.idbb = u.id')
            ->setParameter('adresse','%'.$motcle.'%')
            ->orderBy('m.adresse','ASC')
            ->getQuery();

        $produits=$query->getResult();

        $query2 = $em->createQuery("select m.idDemande,m.dateDebut,m.dateFin,m.heureDebut,m.heureFin,m.description,u.username from UserBundle:DemandesParent m join UserBundle:User u where u.id=m.idBabysitter and m.idParent =:x")
            ->setParameter('x', $user->getId());

        $equipes2 = $query2->getResult();

        return $this->render('FrontBundle:Default:profilReserv.html.twig',array('m'=>$produits,'m1'=>$equipes2));
    }
    public function supprimerReservAction($refD,Request $request){
        $em=$this->getDoctrine()->getManager();
        $recherche=$em->getRepository('UserBundle:DemandesParent')->findOneBy(array('idDemande'=>$refD));
        $equipes=$em->getRepository('UserBundle:OffresBabysitter')->findAll();

        foreach ($equipes as $m) {

            $m->setNote(null);
            $em->persist($m);
            $em->flush();
        }
        if($recherche==null){
            $request->getSession()
                ->getFlashBag()
                ->add('danger', 'Vous avez déjà participer à une étape ')
            ;
        }
        else{
        $em=$this->getDoctrine()->getManager();
        $voiture=$em->find(DemandesParent::class,$refD);
        $em->remove($voiture);
        $em->flush();
        return $this->redirectToRoute('profilReserv');}
    }

    public function recherchetriAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em=$this->getDoctrine()->getManager();

        $equipes=$em->getRepository('UserBundle:OffresBabysitter')->findAll();

        foreach ($equipes as $m) {

            $m->setNote(null);
            $em->persist($m);
            $em->flush();
        }
        if ($request->getMethod() == "POST") {
            $lieu = $request->get('lieu');
            if(($lieu!="b")&&($lieu!="c")&&($lieu!="d")){
                $em=$this->getDoctrine()->getManager();

                $query=$em->createQueryBuilder()
                    ->select('m.idOffre,m.dateProfil,u.username,u.email,m.description,m.adresse,m.sexe,m.numtel,m.experience,m.lieu_baby,m.fumeuse,m.enfant,m.conduite,m.agregation,m.dispo,m.age,m.image')->from('UserBundle:OffresBabysitter','m')
                    ->join('UserBundle:User','u')
                    ->where('m.idbb = u.id')
                    ->orderBy('m.dateProfil','DESC')
                    ->getQuery();

                $produits=$query->getResult();

            }
            if(($lieu!="a")&&($lieu!="c")&&($lieu!="d")){
                $em=$this->getDoctrine()->getManager();

                $query=$em->createQueryBuilder()
                    ->select('m.idOffre,m.dateProfil,u.username,u.email,m.description,m.adresse,m.sexe,m.numtel,m.experience,m.lieu_baby,m.fumeuse,m.enfant,m.conduite,m.agregation,m.dispo,m.age,m.image')->from('UserBundle:OffresBabysitter','m')
                    ->join('UserBundle:User','u')
                    ->where('m.idbb = u.id')
                    ->orderBy('m.age','DESC')
                    ->getQuery();

                $produits=$query->getResult();

            }
            if(($lieu!="a")&&($lieu!="b")&&($lieu!="d")){
                $em=$this->getDoctrine()->getManager();

                $query=$em->createQueryBuilder()
                    ->select('m.idOffre,m.dateProfil,u.username,u.email,m.description,m.adresse,m.sexe,m.numtel,m.experience,m.lieu_baby,m.fumeuse,m.enfant,m.conduite,m.agregation,m.dispo,m.age,m.image')->from('UserBundle:OffresBabysitter','m')
                    ->join('UserBundle:User','u')
                    ->where('m.idbb = u.id')
                    ->orderBy('m.adresse','ASC')
                    ->getQuery();

                $produits=$query->getResult();

            }
            if(($lieu!="a")&&($lieu!="b")&&($lieu!="c")){
                $em=$this->getDoctrine()->getManager();

                $query=$em->createQueryBuilder()
                    ->select('m.idOffre,m.dateProfil,u.username,u.email,m.description,m.adresse,m.sexe,m.numtel,m.experience,m.lieu_baby,m.fumeuse,m.enfant,m.conduite,m.agregation,m.dispo,m.age,m.image')->from('UserBundle:OffresBabysitter','m')
                    ->join('UserBundle:User','u')
                    ->where('m.idbb = u.id')
                    ->orderBy('u.username','ASC')
                    ->getQuery();

                $produits=$query->getResult();

            }

        }
        $query2 = $em->createQuery("select m.idDemande,m.dateDebut,m.dateFin,m.heureDebut,m.heureFin,m.description,u.username from UserBundle:DemandesParent m join UserBundle:User u where u.id=m.idBabysitter and m.idParent =:x")
            ->setParameter('x', $user->getId());

        $equipes2 = $query2->getResult();
        return $this->render('FrontBundle:Default:profilReserv.html.twig', array(
            'm'=>$produits,'m1'=>$equipes2));
    }

   public function accepterReservAction($idReserv,Request $request)
   {
       $user = $this->get('security.token_storage')->getToken()->getUser();
       $em=$this->getDoctrine()->getManager() ;
       $equipes=$em->getRepository('UserBundle:OffresBabysitter')->findAll();

       foreach ($equipes as $m) {

           $m->setNote(null);
           $em->persist($m);
           $em->flush();
       }
       $mark=$em->getRepository('UserBundle:DemandesParent')->find($idReserv) ;
    if($mark->getEtat()==0)
    {
        $request->getSession()
            ->getFlashBag()
            ->add('accepter', "Vous avez accepter cette reservation!");
    }
    $mark->setEtat(2) ;
    $mark->setNbApp(1);
    $em->persist($mark) ;
    $em->flush() ;
    return $this->redirectToRoute('profilBB') ;
 }
   public function refuserReservAction($idReserv,Request $request){
           $user = $this->get('security.token_storage')->getToken()->getUser();
           $em=$this->getDoctrine()->getManager() ;
       $equipes=$em->getRepository('UserBundle:OffresBabysitter')->findAll();

       foreach ($equipes as $m) {

           $m->setNote(null);
           $em->persist($m);
           $em->flush();
       }
       $mark=$em->getRepository('UserBundle:DemandesParent')->find($idReserv) ;
       if($mark->getEtat()==0)
       {
           $request->getSession()
               ->getFlashBag()
               ->add('refuser', "Vous avez refuser cette reservation!");
       }
       $mark->setEtat(1) ;
       $mark->setNbApp(1);
       $em->persist($mark) ;
       $em->flush() ;


               return $this->redirectToRoute('profilBB') ;





}

}
