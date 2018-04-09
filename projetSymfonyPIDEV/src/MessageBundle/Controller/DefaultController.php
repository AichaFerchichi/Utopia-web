<?php

namespace MessageBundle\Controller;

use MessageBundle\Entity\Favoris;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MessageBundle:Default:chat.html.twig');
    }
}


