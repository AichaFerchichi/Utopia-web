<?php

namespace UserBundle\Controller;


use UserBundle\Entity\CheckQuiz;
use UserBundle\Entity\Userquiz;
use UserBundle\Form\CheckQuizType;
use UserBundle\Form\RechercheForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Quiz;
use UserBundle\Form\QuizType;
use UserBundle\UserBundle;

class QuizController extends Controller
{
    public function indexAction()
    {
        return $this->render('BackBundle:Default:quiz.html.twig');
    }
    public function ajoutAction(Request $request)
    {
        $joueur= new Quiz();

        $form=$this->createForm(QuizType::class,$joueur);
        if ($form->handleRequest($request)->isValid())
        {/**
         * @var UploadedFile $file
         */
            $file=$joueur->getImage() ;
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('image_directory'),$fileName) ;
            $joueur->setImage($fileName) ;
            $em=$this->getDoctrine()->getManager();
$joueur->setEtat(0);
            $em->persist($joueur);
            $em->flush();

            //return $this->redirectToRoute('affiche');
            return $this->redirectToRoute('quiz');

        }
        $em=$this->getDoctrine()->getManager();
        $equipes=$em->getRepository('UserBundle:Quiz')->findAll();
        foreach ($equipes as $e){
            $quiz=$e;

        }
$actuel=$em->getRepository('UserBundle:Quiz')->findOneBy(array('etat'=>1));

        return $this->render('BackBundle:Default:quiz.html.twig',array('f'=>$form->createView(),'m'=>$equipes,'quizj'=>$quiz,'Q'=>$actuel));

    }

    public function rechercherAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        $motcle=$request->get('motcle');
        $repository=$em->getRepository('UserBundle:Quiz');
        $query=$em->createQueryBuilder()
            ->select('p')->from('UserBundle:Quiz','p')
            ->where('p.theme like :theme')
            ->setParameter('theme','%'.$motcle.'%')
            ->orderBy('p.theme','ASC')
            ->getQuery();

        $produits=$query->getResult();
//ajout
        $joueur= new Quiz();

        $form=$this->createForm(QuizType::class,$joueur);
        if ($form->handleRequest($request)->isValid())
        {/**
         * @var UploadedFile $file
         */
            $file=$joueur->getImage() ;
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('image_directory'),$fileName) ;
            $joueur->setImage($fileName) ;
            $em=$this->getDoctrine()->getManager();
            $joueur->setEtat(0);
            $em->persist($joueur);
            $em->flush();
            //return $this->redirectToRoute('affiche');
            return $this->redirectToRoute('quiz');

        }
        foreach ($produits as $e){
            $quiz=$e;

        }
        $actuel=$em->getRepository('UserBundle:Quiz')->findOneBy(array('etat'=>1));
        return $this->render('BackBundle:Default:quiz.html.twig',array('m'=>$produits,'f'=>$form->createView(),'quizj'=>$quiz,'Q'=>$actuel));
    }

    public function affichageAction(Request $request,$id)
    {

        $user = $this->get('security.token_storage')->getToken()->getUser();

        if ($user=='anon.')
            return $this->redirectToRoute('fos_user_security_login');


        else {

            $em=$this->getDoctrine()->getManager();
            $actuel=$em->getRepository('UserBundle:Quiz')->findOneBy(array('etat'=>1));
            $présent=$em->getRepository('UserBundle:Userquiz')->findOneBy(array('idQuiz'=>$actuel->getIdQuiz(),'idUser'=>$user->getId()));
if($présent!=null){
    return    $this->redirectToRoute('DejaJoue',array('id'=>$id));
}else{
            $joueur = new CheckQuiz();
            $userQuiz= new Userquiz();

            $form = $this->createForm(CheckQuizType::class, $joueur);
            if ($form->handleRequest($request)->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $joueur->setIdQuiz($actuel);
                $userQuiz->setIdUser($user);
                $userQuiz->setIdQuiz($actuel);
                $em->persist($joueur);
                $em->persist($userQuiz);
                $em->flush();
                $correcte=$em->getRepository('UserBundle:CheckQuiz')->findOneBy(array('idQuiz'=>$actuel->getIdQuiz()));
                if($actuel->getRep1()==$actuel->getRepC()){
                    if($correcte->getEn1()==1){
                     return   $this->redirectToRoute('bravo',array('id'=>$id));

                    }
                    else{
                        return    $this->redirectToRoute('echec',array('id'=>$id));
                    }

                }
                elseif ($actuel->getRep2()==$actuel->getRepC()){

                    if($correcte->getEn2()==1){
                        return    $this->redirectToRoute('bravo',array('id'=>$id));

                    }
                    else{
                        return    $this->redirectToRoute('echec',array('id'=>$id));
                    }
                }
                elseif ($actuel->getRep3()==$actuel->getRepC()){

                    if($correcte->getEn3()==1){
                        return    $this->redirectToRoute('bravo',array('id'=>$id));

                    }
                    else{
                        return    $this->redirectToRoute('echec',array('id'=>$id));
                    }
                }

                //return $this->redirectToRoute('affiche');
                //return $this->redirectToRoute('quizF',array('f'=>$form->createView(),'id'=>$id,'quiz'=>$actuel));

            }}
        }
            return $this->render('FrontBundle:Default:quiz.html.twig',array('f'=>$form->createView(),'id'=>$id,'quiz'=>$actuel));

    }

    public function modifierAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $mark = $em->getRepository('UserBundle:Quiz')->find($id);
        $form = $this->createForm(QuizType::class, $mark);
        $equipes=$em->getRepository('UserBundle:Quiz')->findAll();
        foreach ($equipes as $e){
            $quiz=$e;

        }
        $actuel=$em->getRepository('UserBundle:Quiz')->findOneBy(array('etat'=>1));
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
            return $this->redirectToRoute('quiz',array('quizj'=>$quiz,'m'=>$equipes,'Q'=>$actuel));
        }

        return $this->render('BackBundle:Default:modifierQuiz.html.twig', array('f' => $form->createView()));
    }


    public function deleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $equipe=$em->find(Quiz::class,$id);
        $em->remove($equipe);
        $em->flush();
        $equipes=$em->getRepository('UserBundle:Quiz')->findAll();
        foreach ($equipes as $e){
            $quiz=$e;

        }
        $actuel=$em->getRepository('UserBundle:Quiz')->findOneBy(array('etat'=>1));
        return $this->redirectToRoute('quiz',array('quizj'=>$quiz,'m'=>$equipes,'Q'=>$actuel));
    }
    public function validerAction($id){
        $em=$this->getDoctrine()->getManager();
        $actuel1=$em->getRepository('UserBundle:Quiz')->findOneBy(array('etat'=>1));
        $actuel1->setEtat(0);
        $em->persist($actuel1);
        $em->flush();
        $actuel=$em->getRepository('UserBundle:Quiz')->findOneBy(array('idQuiz'=>$id));
        $actuel->setEtat(1);
        $em->persist($actuel);
        $em->flush();
        $equipes=$em->getRepository('UserBundle:Quiz')->findAll();
        foreach ($equipes as $e){
            $quiz=$e;

        }
        return $this->redirectToRoute('quiz',array('quizj'=>$quiz,'m'=>$equipes,'Q'=>$actuel));
    }
    public function bravoAction($id){
        $em=$this->getDoctrine()->getManager();
        $query=$em->createQueryBuilder()
            ->select('p')->from('UserBundle:Produits','p')
            ->orderBy('p.quantite','ASC')
            ->getQuery();

        $produits=$query->getResult();
        foreach ($produits as $e){
            $prod=$e;

        }
        return $this->render('FrontBundle:Default:bravo.html.twig',array('produit'=>$prod,'id'=>$id));
    }
    public function echecAction($id){

        return $this->render('FrontBundle:Default:echec.html.twig',array('id'=>$id));
    }
    public function DejaJoueAction($id){

        return $this->render('FrontBundle:Default:DejaJoue.html.twig',array('id'=>$id));
    }
}
