<?php

namespace UserBundle\Controller;


use UserBundle\Entity\Activite;

use UserBundle\Form\ActiviteType;

use UserBundle\Entity\Etape;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Repository;


class ActiviteController extends Controller
{
    public function indexAction()
    {
        return $this->render('BackBundle:Default:email_inbox.html.twig');
    }
    public function ajoutAction(Request $request,$id)
    {
        $joueur= new Activite();


        $form=$this->createForm(ActiviteType::class,$joueur);
        if ($form->handleRequest($request)->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $etape=$em->getRepository('UserBundle:Etape')->findAll();
            $i=0;
            foreach ( $etape as $e){
                $i=$i+1;
        }
            $equipes=$em->getRepository('UserBundle:Garderies')->findOneBy(array('idGarderie'=>$id));
if(($joueur->getDateDebut() > (new \DateTime('now')))&&($joueur->getDateFin()> (new \DateTime('now'))  )&&($joueur->getDateFin()> $joueur->getDateDebut()))
{   $joueur->setIdGarderie($equipes);
    $em->persist($joueur);
            $em->flush();

            //return $this->redirectToRoute('affiche');
    $equipes=$em->getRepository('UserBundle:Activite')->findOneBy(array('nom'=>$joueur->getNom()));
            return $this->redirectToRoute('etape',array('id'=>$equipes->getIdActivite(),'nb'=>$equipes->getNbEtape(),'etape'=>$i));}
            else{
                $request->getSession()
                    ->getFlashBag()
                    ->add('danger', 'Veuillez vérifier les deux dates')
                ;



            }


        }



        return $this->render('BackBundle:Default:email_inbox.html.twig',array('f'=>$form->createView(),'id'=>$id));

    }
   /* public function ajoutAction(Request $request,$id)
    {
        $marque=new Activite();
        if($request->getMethod()=="POST") {
            $em = $this->getDoctrine()->getManager();
            $etape = $em->getRepository('UserBundle:Etape')->findAll();
            $i = 0;
            foreach ($etape as $e) {
                $i = $i + 1;
            }
            $x = $request->get('nom');
            // var_dump($x);
            $marque->setNom($x);

            $y = $request->get('nbEtape');
            $marque->setNbEtape($y);
            $w = $request->get('dateDebut');
            $marque->setDateDebut($w);
            $z = $request->get('dateFin');
            $marque->setDateFin($z);

            $equipes = $em->getRepository('UserBundle:Garderies')->findOneBy(array('idGarderie' => $id));
           // var_dump($equipes);


                $marque->setIdGarderie($equipes);
               // var_dump($marque);
                $em->persist($marque);
                $em->flush();

                $equipes = $em->getRepository('UserBundle:Activite')->findOneBy(array('nom' => $marque->getNom()));
                return $this->redirectToRoute('etape', array('id' => $equipes->getIdActivite(), 'nb' => $equipes->getNbEtape(), 'etape' => $i));

        }

return $this->render('BackBundle:Default:email_inbox.html.twig',array('id'=>$id));
    }*/
    public function rechercherAction(Request $request,$idG){
        $em=$this->getDoctrine()->getManager();
        $motcle=$request->get('motcle');
        $repository=$em->getRepository('UserBundle:Activite');
        $query=$em->createQueryBuilder()
            ->select('p')->from('UserBundle:Activite','p')
            ->where('p.nom like :nom')
            ->setParameter('nom','%'.$motcle.'%')
            ->orderBy('p.nom','ASC')
            ->getQuery();

        $produits=$query->getResult();



        return $this->render('BackBundle:Default:ListeActivite.html.twig',array('m'=>$produits,'idG'=>$idG));
    }

    public function affichageAction($id)
    {
        $marque=new Activite();

        $em=$this->getDoctrine()->getManager();
$date=(new \DateTime('now'));

        //$equipes=$em->getRepository('UserBundle:Activite')->findDateDebut();
        $query=$em->createQueryBuilder()
            ->select('p')->from('UserBundle:Activite','p')
            ->where('p.dateFin > CURRENT_DATE()')
            ->orderBy('p.dateFin','ASC')
            ->getQuery();

        $equipes=$query->getResult();
        return $this->render('BackBundle:Default:ListeActivite.html.twig', array(
            'm'=>$equipes,'idG'=>$id));

    }
  /*  public function modifierAction(Request $request,$id,$idG)
    {
        $em = $this->getDoctrine()->getManager();
        $mark = $em->getRepository('UserBundle:Activite')->find($id);
        $form = $this->createForm(Activite2Type::class, $mark);
        if ($form->handleRequest($request)->isValid()) {

            $em->persist($mark);
            $em->flush();
            return $this->redirectToRoute('ListeActivite',array('id'=>$idG));
        }
        return $this->render('BackBundle:Default:modifierActivite.html.twig', array('f' => $form->createView()));
    }
*/

    public function deleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $equipe=$em->find(Activite::class,$id);
        $mark = $em->getRepository('UserBundle:Etape')->findBy(array('idActivite'=>$id));
        if($mark==null){
        $em->remove($equipe);
        $em->flush();}
        else{
            foreach ($mark as $m){
                $etape=$em->find(Etape::class,$m->getIdEtape());
                $em->remove($etape);
                $em->flush();
            }
            $em->remove($equipe);
            $em->flush();
        }
        return $this->redirectToRoute('email_compose');
    }
    public function delete2Action($id,$idG)
    {
        $em=$this->getDoctrine()->getManager();
        $equipe=$em->find(Activite::class,$id);
        $mark = $em->getRepository('UserBundle:Etape')->findBy(array('idActivite'=>$id));
        if($mark==null){
            $em->remove($equipe);
            $em->flush();}
        else{
            foreach ($mark as $m){
                $etape=$em->find(Etape::class,$m->getIdEtape());
                $em->remove($etape);
                $em->flush();
            }
            $em->remove($equipe);
            $em->flush();
        }
        return $this->redirectToRoute('ListeActivite',array('id'=>$idG));
    }
}
