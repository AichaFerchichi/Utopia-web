<?php

namespace BackBundle\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile ;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Produits;
use UserBundle\Form\ProduitsType;
use UserBundle\Form\RechercherProduits;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BackBundle:Default:index.html.twig');
    }
    public function accueilAction()
    {
        return $this->render('BackBundle:Default:accueil.html.twig');
    }
    public function app_profileAction()
    {
        return $this->render('BackBundle:Default:app_profile.html.twig');
    }
    public function chart_amchartAction()
    {
        return $this->render('BackBundle:Default:chart_amchart.html.twig');
    }
    public function chart_chartistAction()
    {
        return $this->render('BackBundle:Default:chart_chartist.html.twig');
    }
    public function chart_echartAction()
    {
        return $this->render('BackBundle:Default:chart_echart.html.twig');
    }
    public function chart_flotAction()
    {
        return $this->render('BackBundle:Default:chart_flot.html.twig');
    }
    public function chart_morrisAction()
    {
        return $this->render('BackBundle:Default:chart_morris.html.twig');
    }
    public function chart_peityAction()
    {
        return $this->render('BackBundle:Default:chart_peity.html.twig');
    }
    public function chart_sparklineAction()
    {
        return $this->render('BackBundle:Default:chart_sparkline.html.twig');
    }
    public function email_composeAction()
    {
        return $this->render('BackBundle:Default:email_compose.html.twig');
    }
    public function email_inboxAction()
    {
        return $this->render('BackBundle:Default:email_inbox.html.twig');
    }
    public function email_readAction()
    {
        return $this->render('BackBundle:Default:email_read.html.twig');
    }
    public function form_basicAction()
    {
        return $this->render('BackBundle:Default:form_basic.html.twig');
    }
    public function form_dropzoneAction()
    {
        return $this->render('BackBundle:Default:form_dropzone.html.twig');
    }
    public function form_editorAction()
    {
        return $this->render('BackBundle:Default:form_editor.html.twig');
    }
    public function form_layoutAction()
    {
        return $this->render('BackBundle:Default:form_layout.html.twig');
    }
    public function form_validationAction()
    {
        return $this->render('BackBundle:Default:form_validation.html.twig');
    }
    public function index1Action()
    {
        return $this->render('BackBundle:Default:index1.html.twig');
    }
    public function layout_blankAction()
    {
        return $this->render('BackBundle:Default:layout_blank.html.twig');
    }
    public function layout_boxedAction()
    {
        return $this->render('BackBundle:Default:layout_boxed.html.twig');
    }
    public function map_googleAction()
    {
        return $this->render('BackBundle:Default:map_google.html.twig');
    }
    public function map_vectorAction()
    {
        return $this->render('BackBundle:Default:map_vector.html.twig');
    }
    public function page_invoiceAction()
    {
        return $this->render('BackBundle:Default:page_invoice.html.twig');
    }
    public function page_loginAction()
    {
        return $this->render('BackBundle:Default:page_login.html.twig');
    }
    public function page_registerAction()
    {
        return $this->render('BackBundle:Default:page_register.html.twig');
    }
    public function table_bootstrapAction()
    {
        return $this->render('BackBundle:Default:table_bootstrap.html.twig');
    }
    public function table_databaseAction()
    {
        return $this->render('BackBundle:Default:table_database.html.twig');
    }
    public function uc_calendarAction()
    {
        return $this->render('BackBundle:Default:uc_calendar.html.twig');
    }
    public function uc_toastrAction()
    {
        return $this->render('BackBundle:Default:uc_toastr.html.twig');
    }
    public function ui_alertAction()
    {
        return $this->render('BackBundle:Default:ui_alert.html.twig');
    }
    public function ui_buttonAction()
    {
        return $this->render('BackBundle:Default:ui_button.html.twig');
    }
    public function ui_progressbarAction()
    {
        return $this->render('BackBundle:Default:ui_progressbar.html.twig');
    }
    public function ui_tabAction()
    {
        return $this->render('BackBundle:Default:ui_tab.html.twig');
    }

}
