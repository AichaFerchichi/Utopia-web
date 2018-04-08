<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CommentController extends Controller
{
    public function affichageCommentairesAction($id)
    {

        $em=$this->getDoctrine()->getManager();
        $marks=$em->getRepository('UserBundle:Comment')->findBy(array('idProduit'=>$id)) ;
        $photo=$em->getRepository('UserBundle:Produits')->find($id) ;

        $notes=$em->getRepository('UserBundle:Notes')->findBy(array('idProduit'=>$id)) ;
       $i=0 ;
        foreach ($notes as $n){
            $i=$i+1 ;
        }


        return $this->render('BackBundle:Default:affichageCommentaires.html.twig', array(
            'comments'=>$marks , 'taswira'=>$photo->getImage() , 'nb'=>$i

        ));
    }

}
