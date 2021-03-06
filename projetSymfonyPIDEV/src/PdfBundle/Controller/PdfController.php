<?php
/**
 * Created by PhpStorm.
 * User: hatem
 * Date: 2/26/2018
 * Time: 3:29 AM
 */

namespace PdfBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PdfController extends Controller
{
    public function pdfAction($idG,$idE)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $equipes=$em->getRepository('UserBundle:Garderies')->findOneBy(array('idGarderie'=>$idG));
        $enfant=$em->getRepository('UserBundle:Enfants')->findOneBy(array('idEnfant'=>$idE));
        $html = $this->renderView('PdfBundle:Pdf:Pdf.html.twig',array('enfant'=>$enfant,'garderie'=>$equipes));




        $filename = sprintf('Inscription-%s.pdf', date('Y-m-d'));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
            ]
        );
        return $this->redirectToRoute('care');
    }
}