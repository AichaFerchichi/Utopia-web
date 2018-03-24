<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FrontBundle:Default:index.html.twig');
    }

    public function accueil1Action()
    {
        return $this->render('FrontBundle:Default:accueil1.html.twig');
<<<<<<< HEAD
=======
    }
    public function plusAction()
    {
        return $this->render('FrontBundle:Default:plus.html.twig');
>>>>>>> 3bc1d8a9225682bf1b1b659405e99d34143db1df
    }
    public function wishlistAction()
    {
        return $this->render('FrontBundle:Default:wishlist.html.twig');
    }
    public function aboutAction()
    {
        return $this->render('FrontBundle:Default:about.html.twig');
    }
    public function careAction()
    {
        return $this->render('FrontBundle:Default:care.html.twig');
    }
    public function codesAction()
    {
        return $this->render('FrontBundle:Default:codes.html.twig');
    }
    public function contactAction()
    {
        return $this->render('FrontBundle:Default:contact.html.twig');
    }
    public function faqsAction()
    {
        return $this->render('FrontBundle:Default:faqs.html.twig');
    }
    public function holdAction()
    {
        return $this->render('FrontBundle:Default:hold.html.twig');
    }
    public function kitchenAction()
    {
        return $this->render('FrontBundle:Default:service.html.twig');
    }
    public function loginAction()
    {
        return $this->render('FrontBundle:Default:login.html.twig');
    }
    public function offerAction()
    {
        return $this->render('FrontBundle:Default:offer.html.twig');
    }
    public function registerAction()
    {
        return $this->render('FrontBundle:Default:register.html.twig');
    }
    public function shippingAction()
    {
        return $this->render('FrontBundle:Default:shipping.html.twig');
    }
    public function singleAction()
    {
        return $this->render('FrontBundle:Default:single.html.twig');
    }
    public function termsAction()
    {
        return $this->render('FrontBundle:Default:terms.html.twig');
    }

    public function testRoleUserAction(Request $request){
        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('Exemples_Roles/hello-world-user.html.twig');
    }
    public function testRoleAdminAction(Request $request){
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('Exemples_Roles/hello-world-admin.html.twig');
    }
    public function profilAction()
    {
        return $this->render('FrontBundle:Default:createProfile.html.twig');
    }


}
