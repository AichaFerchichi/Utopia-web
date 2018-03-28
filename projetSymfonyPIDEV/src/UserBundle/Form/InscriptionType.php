<?php

namespace UserBundle\Form;



use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomEnfant',null,array('label'=> 'Nom','attr'=>array('class'=>'form-control', 'placeholder'=>'Veuillez saisir le nom..', 'style'=>'width:300px')))
            ->add('prenom',null,array('label'=> 'Prenom','attr'=>array('class'=>'form-control', 'placeholder'=>'Veuillez saisir le prenom..', 'style'=>'width:300px')))

            ->add('nationalite',null,array('label'=> 'Nationalite','attr'=>array('class'=>'form-control ', 'placeholder'=>'Veuillez saisir la nationalité..', 'style'=>'width:300px')))
            ->add('age',null,array('label'=> 'Age','attr'=>array('class'=>'form-control text-danger','placeholder'=>'Veuillez saisir son age..', 'style'=>'width:300px')))
            ->add('sexe',ChoiceType::class,array('choices'=>array(
                'Garçon'=>'Garçon',
                'Fille'=>'Fille','attr'=>array('class'=>'form-control', 'placeholder'=>'Veuillez saisir le sexe..', 'style'=>'width:300px'))))

            ->add('image', FileType::class, array('data_class' => null,'label' => 'insérer une image','attr'=>array('class'=>'form-control','style'=>'color:violet;width:300px')))
            ->add('Ajouter',SubmitType::class,array('label'=> 'Valider','attr'=>array('class'=>'btn btn-primary ')));

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
