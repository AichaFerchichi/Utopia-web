<?php

namespace UserBundle\Form;



use Doctrine\DBAL\Types\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActiviteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom',null,array('label'=> 'Nom','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus', 'placeholder'=>'Veuillez saisir le nom..', 'style'=>'width:300px')))
            ->add('nbEtape',null,array('label'=> 'nombreEtape','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus', 'placeholder'=>'Veuillez saisir le nombre d etape..', 'style'=>'width:300px')))

            ->add('dateDebut',\Symfony\Component\Form\Extension\Core\Type\DateType::class,array('label'=> 'dateDebut','attr'=>array('class'=>' m-b-15 f-s-12  ')))
            ->add('dateFin', \Symfony\Component\Form\Extension\Core\Type\DateType::class,array('label'=> 'dateFin','attr'=>array('class'=>'m-b-15 f-s-12')))
            ->add('image', FileType::class, array('data_class' => null,'label' => 'insérer une image','attr'=>array('style'=>'color:violet')))
            ->add('Ajouter',SubmitType::class,array('label'=> 'Valider','attr'=>array('class'=>'btn btn-primary')));

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\Activite'
        ));
    }

    public function getBlockPrefix()
    {
        return 'userbundle_activite';
    }
}
