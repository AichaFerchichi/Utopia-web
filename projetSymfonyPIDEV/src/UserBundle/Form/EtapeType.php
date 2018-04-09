<?php

namespace UserBundle\Form;



use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtapeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom',null,array('label'=> 'Nom','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus', 'placeholder'=>'Veuillez saisir le nom..', 'style'=>'width:300px')))
            ->add('description',null,array('label'=> 'Description','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus', 'placeholder'=>'Veuillez saisir la description..', 'style'=>'width:300px')))

            ->add('dateDebut',null,array('label'=> 'dateDebut','attr'=>array('class'=>' m-b-15 f-s-12  ')))
            ->add('dateFin', null,array('label'=> 'dateFin','attr'=>array('class'=>' m-b-15 f-s-12  ')))
            ->add('Ajouter',SubmitType::class,array('label'=> 'Valider','attr'=>array('class'=>'btn btn-primary', 'style'=>'background-color:red;border-color:red')));

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\Etape'
        ));
    }

    public function getBlockPrefix()
    {
        return 'userbundle_etape';
    }
}
