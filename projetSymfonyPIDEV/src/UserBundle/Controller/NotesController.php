<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Entity\Notes;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Form\NotesType;

class NotesController extends Controller
{
    public function ajouterRatingAction(Request $request)
    {
        return $this->render('FrontBundle:Default:single.html.twig', array(

        ));

    }

}
