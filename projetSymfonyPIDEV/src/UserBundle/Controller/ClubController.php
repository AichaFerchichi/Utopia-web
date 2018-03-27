<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ClubController extends Controller
{

    public function afficherAccueilAction()
    {


        return $this->render('FrontBundle:Default:accueilClub.html.twig', array(

            // ...

        ));}

}
