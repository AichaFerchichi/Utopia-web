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

    public function accueilAction()
    {
        return $this->render('FrontBundle:Default:accueil.html.twig');
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
        return $this->render('FrontBundle:Default:kitchen.html.twig');
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



}
