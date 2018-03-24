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

class EnseignantsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom',null,array('label'=> 'Nom','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus', 'placeholder'=>'Veuillez saisir le nom..', 'style'=>'width:300px')))
            ->add('prenom',null,array('label'=> 'Prenom','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus', 'placeholder'=>'Veuillez saisir le nom..', 'style'=>'width:300px')))
            ->add('email',null,array('label'=> 'Email','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus','placeholder'=>'Veuillez saisir le prix..')))
            ->add('cin',null,array('label'=> 'CIN','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus','placeholder'=>'Veuillez saisir la catégorie..')))
            ->add('nom_club',null,array('label'=> 'NomClub','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus','placeholder'=>'Veuillez saisir la catégorie..')))
            ->add('salaire',null,array('label'=> 'salaire','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus','placeholder'=>'Veuillez saisir la description..')))
            ->add('age',null,array('label'=> 'Age','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus','placeholder'=>'Veuillez saisir la quantité..')))
            ->add('diplome',null,array('label'=> 'Diplome','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus','placeholder'=>'Veuillez saisir la quantité..')))

            ->add('image', FileType::class, array('data_class' => null,'label' => 'insérer une image','attr'=>array('style'=>'color:violet')))
            ->add('Ajouter',SubmitType::class,array('label'=> 'Valider','attr'=>array('class'=>'btn btn-primary')));

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\Enseignants'
        ));
    }

    public function getBlockPrefix()
    {
        return 'userbundle_enseignants';
    }
}
