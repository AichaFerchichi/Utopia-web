<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('UserBundle:Default:index.html.twig');
    }
    public function testRoleUserAction(Request $request){
        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('Exemples_Roles/hello-world-user.html.twig');
    }
    public function testRoleAdminAction(Request $request){
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('Exemples_Roles/hello-world-admin.html.twig');
    }
}
