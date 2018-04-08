<?php

namespace UserBundle\Controller;
use blackknight467\StarRatingBundle\Form\RatingType;
use FrontBundle\Form\RatingForm;
use Symfony\Component\HttpFoundation\File\UploadedFile ;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Comment;
use UserBundle\Entity\Notes;
use UserBundle\Entity\Produits;
use UserBundle\Entity\Rate;
use UserBundle\Form\modifProduitsType;
use UserBundle\Form\NotesType;
use UserBundle\Form\ProduitsType;
use UserBundle\Form\RechercherProduits;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProduitsController extends Controller
{
    public function gestionProduitsAction(Request $request)
    {
        //ajout
        $voiture= new Produits();
        $form=$this->createForm(ProduitsType::class,$voiture);
        if ($form->handleRequest($request)->isValid())
        {
            /**
             * @var UploadedFile $file
             */
            $file=$voiture->getImage() ;
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('image_directory'),$fileName) ;
            $voiture->setImage($fileName) ;
            $voiture->setPromotion(0) ;
            $em=$this->getDoctrine()->getManager();
            $em->persist($voiture);
            $em->flush();
            return $this->redirectToRoute('gestionProduits');
        }

        //affichage
        $em=$this->getDoctrine()->getManager();
        $marks=$em->getRepository('UserBundle:Produits')->findAll();


        //rechercher
        /*$voiture2= new Produits();
        $form2=$this->createForm(RechercherProduits::class,$voiture2);
        if ($form2->handleRequest($request)->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $marks=$em->getRepository('UserBundle:Produits')->findBy(array('categorie'=>$voiture2->getCategorie()));
        }*/

        return $this->render('BackBundle:Default:gestionProduits.html.twig', array(
            'm'=>$marks , 'f'=>$form->createView()
        ));


    }

    public function supprimerAction($id){
        $em=$this->getDoctrine()->getManager();
        $equipe=$em->find(Produits::class,$id);
        $em->remove($equipe);
        $em->flush();
        return $this->redirectToRoute('gestionProduits');
    }

    public function modifierAction($id,Request $request){

        $em=$this->getDoctrine()->getManager() ;
        $mark=$em->getRepository('UserBundle:Produits')->find($id) ;
        $form=$this->createForm(ProduitsType::class,$mark) ;
        $name=$mark->getNom() ;

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
            return $this->redirectToRoute('gestionProduits') ;
        }        return $this->render('BackBundle:Default:modifierProduits.html.twig',array( 'e'=> $name , 'f'=>$form->createView())) ;
    }

    public function rechercherProduitAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        $motcle=$request->get('motcle');
        $repository=$em->getRepository('UserBundle:Produits');
        $query=$em->createQueryBuilder()
            ->select('p')->from('UserBundle:Produits','p')
            ->where('p.categorie like :categorie')
            ->setParameter('categorie','%'.$motcle.'%')
            ->orderBy('p.categorie','ASC')
            ->getQuery();

        $produits=$query->getResult();
//ajout
        $joueur= new Produits();


        $form=$this->createForm(ProduitsType::class,$joueur);
        if ($form->handleRequest($request)->isValid())
        {/**
         * @var UploadedFile $file
         */
            $file=$joueur->getImage() ;
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('image_directory'),$fileName) ;
            $joueur->setImage($fileName) ;
            $em->persist($joueur) ;
            $em->flush() ;
            return $this->redirectToRoute('gestionProduits') ;

        }

        return $this->render('BackBundle:Default:gestionProduits.html.twig',array('m'=>$produits,'f'=>$form->createView()));
    }

    public function affichageProduitsAction(){
        $em=$this->getDoctrine()->getManager();
        $marks=$em->getRepository('UserBundle:Produits')->findAll();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $yo= $em->getRepository("UserBundle:Commandes")->findBy(array('idParent'=>$user));
        return $this->render('FrontBundle:Default:Boutique.html.twig', array(
            'm'=>$marks , 'com'=>$yo
        ));
    }

    public function singleAction($id, Request $request){

        $em=$this->getDoctrine()->getManager();
        $marks=$em->getRepository('UserBundle:Produits')->find($id);
        $voitures=$em->getRepository('UserBundle:Promotions')->findOneBy(array('idProduit'=>$id)) ;
        $mot='vêtements';
        $query=$em->createQueryBuilder()
            ->select('p')->from('UserBundle:Produits','p')
            ->where('p.categorie like :categorie')
            ->setParameter('categorie','%'.$mot.'%')
            ->setMaxResults(4)
            ->getQuery();
        $some=$query->getResult();

        //ajout
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $yo= $em->getRepository("UserBundle:Commandes")->findBy(array('idParent'=>$user));


        $bla= new Notes();
        $form=$this->createForm(NotesType::class,$bla);
        if ($form->handleRequest($request)->isValid())
        {
            if ($user=='anon.')
            {  return $this->redirectToRoute('fos_user_security_login');}
            else {
            $em5=$this->getDoctrine()->getManager();
            $bla->setIdParent($user) ;
            $bla->setIdProduit($marks) ;
            // $rate = $request->get('rating') ;
            $bla->setRating(1);
            $em5->persist($bla);
            $em5->flush();
            return $this->redirectToRoute('single', array(
                'id' => $id));}
        }

     /*   $bla2 = new Rate() ;
        $form2=$this->createForm(RatingType::class,$bla2) ; */



        //comment
        $id = 'thread_id';
        $thread = $this->container->get('fos_comment.manager.thread')->findThreadById($id);
        if (null === $thread) {
            $thread = $this->container->get('fos_comment.manager.thread')->createThread();
            $thread->setId($id);
            $thread->setPermalink($request->getUri());
            //$thread->setIdProduit($marks->getIdProduit()) ;

            // Add the thread
            $this->container->get('fos_comment.manager.thread')->saveThread($thread);
        }

        $comments = $this->container->get('fos_comment.manager.comment')->findCommentTreeByThread($thread);
        $em6=$this->getDoctrine()->getManager();
        $com = $em6->getRepository('UserBundle:Comment')->findOneBy(array('thread'=>$thread)) ;
        $com->setIdProduit($marks) ;
        $em6->persist($com) ;
        $em6->flush();

        //$comments->setIdProduit($voitures->getIdProduit()) ;


        //comment


        return $this->render('FrontBundle:Default:single.html.twig', array(
            'i'=>$marks , 'e'=>$voitures , 'some'=>$some , 'comments' => $comments,
            'thread' => $thread,'f'=>$form->createView() , 'com'=>$yo
        ));
    }

    public function single2Action($id, Request $request){
        $em=$this->getDoctrine()->getManager();
        $marks=$em->getRepository('UserBundle:Produits')->find($id);
        $voitures=$em->getRepository('UserBundle:Promotions')->findOneBy(array('idProduit'=>$id)) ;
        $mot='jouets';
        $query=$em->createQueryBuilder()
            ->select('p')->from('UserBundle:Produits','p')
            ->where('p.categorie like :categorie')
            ->setParameter('categorie','%'.$mot.'%')
            ->setMaxResults(4)
            ->getQuery();
        $some=$query->getResult();

        //ajout
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $yo= $em->getRepository("UserBundle:Commandes")->findBy(array('idParent'=>$user));
        /* if ($user=='anon.')
             return $this->redirectToRoute('fos_user_security_login');*/
        $bla= new Notes();
        $form=$this->createForm(NotesType::class,$bla);
        if ($form->handleRequest($request)->isValid())
        {
            $em5=$this->getDoctrine()->getManager();
            $bla->setIdParent($user) ;
            $bla->setIdProduit($marks) ;
            // $rate = $request->get('rating') ;
            $bla->setRating(1);
            $em5->persist($bla);
            $em5->flush();
            return $this->redirectToRoute('single', array(
                'id' => $id));
        }

        /*   $bla2 = new Rate() ;
           $form2=$this->createForm(RatingType::class,$bla2) ; */



        //comment
        $id = 'thread_id';
        $thread = $this->container->get('fos_comment.manager.thread')->findThreadById($id);
        if (null === $thread) {
            $thread = $this->container->get('fos_comment.manager.thread')->createThread();
            $thread->setId($id);
            $thread->setPermalink($request->getUri());
            //$thread->setIdProduit($marks->getIdProduit()) ;

            // Add the thread
            $this->container->get('fos_comment.manager.thread')->saveThread($thread);
        }

        $comments = $this->container->get('fos_comment.manager.comment')->findCommentTreeByThread($thread);
        $em6=$this->getDoctrine()->getManager();
        $com = $em6->getRepository('UserBundle:Comment')->findOneBy(array('thread'=>$thread)) ;
        $com->setIdProduit($marks) ;
        $em6->persist($com) ;
        $em6->flush();

        //$comments->setIdProduit($voitures->getIdProduit()) ;


        //comment
        return $this->render('FrontBundle:Default:single2.html.twig', array(
            'i'=>$marks , 'e'=>$voitures , 'some'=>$some , 'comments' => $comments,
            'thread' => $thread,'f'=>$form->createView(), 'com'=>$yo
        ));
    }

    public function single3Action($id, Request $request){
        $em=$this->getDoctrine()->getManager();
        $marks=$em->getRepository('UserBundle:Produits')->find($id);
        $voitures=$em->getRepository('UserBundle:Promotions')->findOneBy(array('idProduit'=>$id)) ;
        $mot='fournitures';
        $query=$em->createQueryBuilder()
            ->select('p')->from('UserBundle:Produits','p')
            ->where('p.categorie like :categorie')
            ->setParameter('categorie','%'.$mot.'%')
            ->setMaxResults(4)
            ->getQuery();
        $some=$query->getResult();

        //ajout
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $yo= $em->getRepository("UserBundle:Commandes")->findBy(array('idParent'=>$user));
        /* if ($user=='anon.')
             return $this->redirectToRoute('fos_user_security_login');*/
        $bla= new Notes();
        $form=$this->createForm(NotesType::class,$bla);
        if ($form->handleRequest($request)->isValid())
        {
            $em5=$this->getDoctrine()->getManager();
            $bla->setIdParent($user) ;
            $bla->setIdProduit($marks) ;
            // $rate = $request->get('rating') ;
            $bla->setRating(1);
            $em5->persist($bla);
            $em5->flush();
            return $this->redirectToRoute('single', array(
                'id' => $id));
        }

        /*   $bla2 = new Rate() ;
           $form2=$this->createForm(RatingType::class,$bla2) ; */



        //comment
        $id = 'thread_id';
        $thread = $this->container->get('fos_comment.manager.thread')->findThreadById($id);
        if (null === $thread) {
            $thread = $this->container->get('fos_comment.manager.thread')->createThread();
            $thread->setId($id);
            $thread->setPermalink($request->getUri());
            //$thread->setIdProduit($marks->getIdProduit()) ;

            // Add the thread
            $this->container->get('fos_comment.manager.thread')->saveThread($thread);
        }

        $comments = $this->container->get('fos_comment.manager.comment')->findCommentTreeByThread($thread);
        $em6=$this->getDoctrine()->getManager();
        $com = $em6->getRepository('UserBundle:Comment')->findOneBy(array('thread'=>$thread)) ;
        $com->setIdProduit($marks) ;
        $em6->persist($com) ;
        $em6->flush();

        //$comments->setIdProduit($voitures->getIdProduit()) ;


        //comment
        return $this->render('FrontBundle:Default:single3.html.twig', array(
            'i'=>$marks , 'e'=>$voitures , 'some'=>$some , 'comments' => $comments,
            'thread' => $thread,'f'=>$form->createView(), 'com'=>$yo
        ));
    }

    public function nosJouetsAction(){
        $em=$this->getDoctrine()->getManager();
        $marks=$em->getRepository('UserBundle:Produits')->findBy(array('categorie'=>'jouets'));
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $yo= $em->getRepository("UserBundle:Commandes")->findBy(array('idParent'=>$user));
        return $this->render('FrontBundle:Default:nosJouets.html.twig', array(
            'm'=>$marks, 'com'=>$yo
        ));
    }
    public function nosVetementsAction(){
        $em=$this->getDoctrine()->getManager();
        $marks=$em->getRepository('UserBundle:Produits')->findBy(array('categorie'=>'vêtements'));
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $yo= $em->getRepository("UserBundle:Commandes")->findBy(array('idParent'=>$user));
        return $this->render('FrontBundle:Default:nosVetements.html.twig', array(
            'm'=>$marks, 'com'=>$yo
        ));
    }

    public function nosFournituresAction(){
        $em=$this->getDoctrine()->getManager();
        $marks=$em->getRepository('UserBundle:Produits')->findBy(array('categorie'=>'fournitures'));
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $yo= $em->getRepository("UserBundle:Commandes")->findBy(array('idParent'=>$user));
        return $this->render('FrontBundle:Default:nosFournitures.html.twig', array(
            'm'=>$marks, 'com'=>$yo
        ));
    }


}
