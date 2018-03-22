<?php

namespace UserBundle\Form;



use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnfantsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomEnfant',null,array('label'=> 'Nom','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus', 'placeholder'=>'Veuillez saisir le nom..', 'style'=>'width:300px')))
            ->add('prenom',null,array('label'=> 'Prenom','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus', 'placeholder'=>'Veuillez saisir le prenom..', 'style'=>'width:300px')))
            ->add('idGarderie',EntityType::class,array('class'=>'UserBundle\Entity\Garderies','choice_label'=>'nom','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus', 'placeholder'=>'Veuillez saisir la garderie..', 'style'=>'width:300px')))
            ->add('idParent',EntityType::class,array('class'=>'UserBundle\Entity\User','choice_label'=>'username','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus', 'placeholder'=>'Veuillez saisir le parent..', 'style'=>'width:300px')))
            ->add('age',null,array('label'=> 'Age','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus','placeholder'=>'Veuillez saisir son age..')))
            ->add('image', FileType::class, array('data_class' => null,'label' => 'insérer une image','attr'=>array('style'=>'color:violet')))
            ->add('Ajouter',SubmitType::class,array('label'=> 'Valider','attr'=>array('class'=>'btn btn-primary')));

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\Enfants'
        ));
    }

    public function getBlockPrefix()
    {
        return 'userbundle_enfants';
    }
}
