<?php

namespace UserBundle\Controller;


use UserBundle\Entity\Activite;
use UserBundle\Entity\Enfants;
use UserBundle\Entity\Etape;
use UserBundle\Entity\UserEtape;
use UserBundle\Form\ActiviteType;
use UserBundle\Form\EnfantsType;

use UserBundle\Form\EtapeType;
use UserBundle\Form\RechercheForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Enseignants;


class EtapeController extends Controller
{
    public function indexAction()
    {
        return $this->render('BackBundle:Default:etape.html.twig');
    }
    /*public function ajoutAction(Request $request,$id,$nb,$etape)
    {
        $joueur= new Etape();


        $form=$this->createForm(EtapeType::class,$joueur);
        if ($form->handleRequest($request)->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $equipes=$em->getRepository('UserBundle:Activite')->findOneBy(array('idActivite'=>$id));
            $equipes2=$em->getRepository('UserBundle:Garderies')->findOneBy(array('idGarderie'=>$equipes->getIdGarderie()->getIdGarderie()));
if(($joueur->getDateDebut() < $equipes->getDateDebut() )&&($joueur->getDateFin()< $equipes->getDateFin() )&&($joueur->getDateDebut()> (new \DateTime('now')))&&($joueur->getDateFin()> (new \DateTime('now')))&&($joueur->getDateFin()> $joueur->getDateDebut()))
{   $joueur->setIdActivite($equipes);
$joueur->setNbPlace($equipes2->getNbEnfant()/$equipes->getNbEtape());
    $em->persist($joueur);
            $em->flush();
            //return $this->redirectToRoute('affiche');
            return $this->redirectToRoute('email_compose');}
            else{
                $request->getSession()
                    ->getFlashBag()
                    ->add('danger', 'Veuillez vérifier les deux dates')
                ;



            }


        }



        return $this->render('BackBundle:Default:etape.html.twig',array('f'=>$form->createView(),'id'=>$id,'nb'=>$nb,'etape'=>$etape));

    }*/
    public function ajoutAction(Request $request,$nb,$id,$etape)
    {
        $marque=new Etape();
        if($request->getMethod()=="POST"){

            $x=$request->get('nom');
           // var_dump($x);
            $marque->setNom($x);
            $y=$request->get('description');
            $marque->setDescription($y);
            $w=$request->get('dateDebut');
            $marque->setDateDebut($w);
            $z=$request->get('dateFin');
            $marque->setDateFin($z);
            $em=$this->getDoctrine()->getManager();
            $equipes=$em->getRepository('UserBundle:Activite')->findOneBy(array('idActivite'=>$id));
            $equipes2=$em->getRepository('UserBundle:Garderies')->findOneBy(array('idGarderie'=>$equipes->getIdGarderie()->getIdGarderie()));

               $marque->setIdActivite($equipes);
                $marque->setNbPlace($equipes2->getNbEnfant()/$equipes->getNbEtape());
            $em->persist($marque);
            $em->flush();
                return $this->redirectToRoute('etape',array('id'=>$id,'nb'=>$nb,'etape'=>$etape));
           // return new Response('insertion avec succès');
        }
        return $this->render('BackBundle:Default:etape.html.twig', array('id'=>$id,'nb'=>$nb,'etape'=>$etape
        ));
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

   /* public function affichageAction()
    {
        $marque=new Enfants();

        $em=$this->getDoctrine()->getManager();

        $equipes=$em->getRepository('UserBundle:Enfants')->findAll();

        return $this->render('BackBundle:Default:email_read2.html.twig', array(
            'm'=>$equipes));

    }*/
    public function affichageFAction($id)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        if ($user=='anon.')
            return $this->redirectToRoute('fos_user_security_login');
        else {
            $marque = new Etape();

            $em = $this->getDoctrine()->getManager();
            $date = (new \DateTime('now'));

            //$equipes=$em->getRepository('UserBundle:Activite')->findDateDebut();
            $query = $em->createQueryBuilder()
                ->select('p')->from('UserBundle:Etape', 'p')
                ->where('p.dateFin > CURRENT_DATE() and p.idActivite =:x')
                ->setParameter('x', $id)
                ->orderBy('p.dateFin', 'ASC')
                ->getQuery();

            $equipes = $query->getResult();}
            return $this->render('FrontBundle:Default:etapes.html.twig', array(
                'm' => $equipes, 'id' => $id));

    }
    public function validerAction(Request $request,$id,$etape,$nb)
    {
        $marque=new Etape();

        $em=$this->getDoctrine()->getManager();

        $equipes=$em->getRepository('UserBundle:Etape')->findAll();
        $i=0;
        foreach ( $equipes as $e){
            $i=$i+1;
        }
        if($i!=$etape+$nb)
        {
            $request->getSession()
                ->getFlashBag()
                ->add('danger', 'Vous devez terminer toutes les étapes!')
            ;
        }
        else{
            return $this->redirectToRoute('email_compose');
        }
        return $this->render('BackBundle:Default:etape.html.twig', array(
            'id'=>$id,'etape'=>$etape,'nb'=>$nb));

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
public function participerAction($idE,Request $request,$id){
        //affichage
    $user = $this->get('security.token_storage')->getToken()->getUser();
    $em = $this->getDoctrine()->getManager();
    if ($user=='anon.')
        return $this->redirectToRoute('fos_user_security_login');
    else {
        $marque = new UserEtape();

        $em = $this->getDoctrine()->getManager();
        $date = (new \DateTime('now'));

        //$equipes=$em->getRepository('UserBundle:Activite')->findDateDebut();
        $query = $em->createQueryBuilder()
            ->select('p')->from('UserBundle:Etape', 'p')
            ->where('p.dateFin > CURRENT_DATE() and p.idActivite =:x')
            ->setParameter('x', $id)
            ->orderBy('p.dateFin', 'ASC')
            ->getQuery();

        $equipes = $query->getResult();}
        //participer
    $em = $this->getDoctrine()->getManager();
    $user = $this->get('security.token_storage')->getToken()->getUser();
    $mark = $em->getRepository('UserBundle:Etape')->findOneBy(array('idEtape'=>$idE));
    $recherche=$em->getRepository('UserBundle:UserEtape')->findOneBy(array('idUser'=>$user->getId(),'idActivite'=>$mark->getIdActivite()));
    if($recherche!=null){
        $request->getSession()
            ->getFlashBag()
            ->add('danger', 'Vous avez déjà participer à une étape ')
        ;
    }else{
    if( $mark->getNbPlace()!=0) {
        $mark->setNbPlace($mark->getNbPlace() - 1);
        $marque->setIdActivite($mark->getIdActivite());
        $marque->setIdUser($user);
        $marque->setIdEtape($mark);
        $em->persist($mark);
        $em->persist($marque);
        $em->flush();

        return $this->redirectToRoute('etapeF', array('idE' => $idE,'id'=>$id,'m' => $equipes));
    }
    else{
        $request->getSession()
            ->getFlashBag()
            ->add('danger', 'Il n y a plus de place désolé cher utilisateur! A la prochaine')
        ;

    }
    }


    return $this->render('FrontBundle:Default:etapes.html.twig', array('idE' => $idE,'id'=>$id,'m' => $equipes));
}

    public function deleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $equipe=$em->find(Enfants::class,$id);
        $em->remove($equipe);
        $em->flush();
        return $this->redirectToRoute('email_read2');
    }
    public function annulerAction($idE,Request $request,$id){
        //affichage
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        if ($user=='anon.')
            return $this->redirectToRoute('fos_user_security_login');
        else {
            $marque = new UserEtape();

            $em = $this->getDoctrine()->getManager();
            $date = (new \DateTime('now'));

            //$equipes=$em->getRepository('UserBundle:Activite')->findDateDebut();
            $query = $em->createQueryBuilder()
                ->select('p')->from('UserBundle:Etape', 'p')
                ->where('p.dateFin > CURRENT_DATE() and p.idActivite =:x')
                ->setParameter('x', $id)
                ->orderBy('p.dateFin', 'ASC')
                ->getQuery();

            $equipes = $query->getResult();}
        //annuler
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $mark = $em->getRepository('UserBundle:Etape')->findOneBy(array('idEtape'=>$idE));
        $recherche=$em->getRepository('UserBundle:UserEtape')->findOneBy(array('idUser'=>$user->getId(),'idActivite'=>$mark->getIdActivite()));
        $recherche2=$em->getRepository('UserBundle:UserEtape')->findOneBy(array('idUser'=>$user->getId(),'idActivite'=>$mark->getIdActivite(),'idEtape'=>$idE));
        if($recherche!=null){
            if($recherche2!=null) {
                $mark->setNbPlace($mark->getNbPlace() + 1);
                $em->remove($recherche);
                $em->persist($mark);

                $em->flush();
            }
        else{
            $request->getSession()
                ->getFlashBag()
                ->add('danger', 'Vous n avez participer à cette étape')
            ;

        }
        }else{
            $request->getSession()
                ->getFlashBag()
                ->add('danger', 'Vous n avez participer à aucune étape')
            ;

        }


        return $this->render('FrontBundle:Default:etapes.html.twig', array('idE' => $idE,'id'=>$id,'m' => $equipes));
    }

}
