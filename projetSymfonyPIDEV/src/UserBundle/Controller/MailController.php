<?php

namespace UserBundle\Controller;


use UserBundle\Entity\Mail;

use UserBundle\Form\MailType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Swift_Message;
use Symfony\Component\HttpFoundation\Response;


class MailController extends Controller
{
    public function indexAction(Request $request,$id)
    {
        $mail = new Mail();
        $em=$this->getDoctrine()->getManager();
        $enfant=$em->getRepository('UserBundle:Enfants')->findOneBy(array('idEnfant'=>$id));
        $parent=$em->getRepository('UserBundle:User')->findOneBy(array('id'=>$enfant->getIdParent()));
        $form = $this->createForm(MailType::class, $mail);
        $mail->setEmail($parent->getEmail());
        $form->handleRequest($request);
        if ($form->isValid()) {
                $message = \Swift_Message::newInstance()
                    ->setSubject($mail->getSubject())
                    ->setFrom('espritmail2@gmail.com')
                    ->setTo($mail->getEmail())
                    ->setBody(
                        $mail->getText()

                    );
$this->get('mailer')->send($message);
//return $this->redirect($this->generateUrl('my_app_mail_accuse'));

            //return $this->redirectToRoute('email',array('id'=>$id));
            $request->getSession()
                ->getFlashBag()
                ->add('danger', 'Succès d envoi');





        }
        return $this->render('BackBundle:Default:indexM.html.twig',
            array('form' => $form->createView()));
    }

    /*public function successAction(){
        /*return new Response("email envoyé avec succès, Merci de vérifier votre boite
mail.");
        return $this->render('BackBundle:Default:email_read2.html.twig');

    }*/

}
