<?php

namespace UserBundle\Form;


use Doctrine\DBAL\Types\IntegerType;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GarderiesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom',null,array('label'=> 'Nom','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus', 'placeholder'=>'Veuillez saisir le nom..', 'style'=>'width:300px')))
            ->add('Email',null,array('label'=> 'Email','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus','placeholder'=>'Veuillez saisir le prix..')))
            ->add('adresse',null,array('label'=> 'Adresse','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus','placeholder'=>'Veuillez saisir la catégorie..')))
            ->add('num_tel',null,array('label'=> 'Numéro','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus','placeholder'=>'Veuillez saisir la catégorie..')))
            ->add('description',null,array('label'=> 'Description','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus','placeholder'=>'Veuillez saisir la description..')))
            ->add('image', FileType::class, array('data_class' => null,'label' => 'insérer une image','attr'=>array('style'=>'color:violet')))
            ->add('proEducatif',null,array('label'=> 'Programme','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus','placeholder'=>'Veuillez saisir la quantité..')))
            ->add('objectif',null,array('label'=> 'Objectif','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus','placeholder'=>'Veuillez saisir la quantité..')))
            ->add('nbEnfant',null,array('label'=> 'NombreEnfant','attr'=>array('min' =>0,'class'=>'text-muted m-b-15 f-s-12 form-control input-focus','placeholder'=>'Veuillez saisir la quantité..')))
            ->add('nb_place_dispo',null,array('label'=> 'NombrePlace','attr'=>array('min' =>0,'class'=>'text-muted m-b-15 f-s-12 form-control input-focus','placeholder'=>'Veuillez saisir la quantité..')))
            ->add('Ajouter',SubmitType::class,array('label'=> 'Valider','attr'=>array('class'=>'btn btn-primary')));
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\Garderies'
        ));
    }

    public function getBlockPrefix()
    {
        return 'userbundle_garderies';
    }
}
