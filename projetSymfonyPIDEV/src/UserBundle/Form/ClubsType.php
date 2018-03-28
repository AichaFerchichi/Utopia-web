<?php

namespace UserBundle\Form;



use Doctrine\DBAL\Types\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClubsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder ->add('cin_proprietaire',null,array('label'=>'CIN','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus', 'placeholder'=>'Veuillez saisir CIN..', 'style'=>'width:300px')))
            ->add('email',EmailType::class,array('label'=>'Email','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus', 'placeholder'=>'Veuillez saisir l email..', 'style'=>'width:300px')))
            ->add('nom_club',null,array('label'=> 'NomClub','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus', 'placeholder'=>'Veuillez saisir le nom..', 'style'=>'width:300px')))

            ->add('categorie',ChoiceType::class,array('choices'=>array(
                'Musique'=>'Musique',
                'Danse'=>'Danse',
            'Thêatre'=>'Thêatre',
                'Divertissement'=>'Divertissement',
                'Peinture'=>' Peinture',
                'Autres'=>'Autres',
            'attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus', 'placeholder'=>'Veuillez saisir la categorie..', 'style'=>'width:300px'))))
            ->add('description',null,array('label'=> 'Description','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus', 'placeholder'=>'Veuillez saisir la description..', 'style'=>'width:300px')))

            ->add('nombre_membre',\Symfony\Component\Form\Extension\Core\Type\IntegerType::class,array('label'=> 'Nombre_membre','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus','min'=>0, 'placeholder'=>'Veuillez saisir le nombre..', 'style'=>'width:300px')))
            ->add('nombre_personnels',\Symfony\Component\Form\Extension\Core\Type\IntegerType::class,array('label'=> 'Nombre_personnels','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus','min'=>0,'placeholder'=>'Veuillez saisir le nombre..', 'style'=>'width:300px')))
            ->add('lieu',null,array('label'=> 'Lieu','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus', 'placeholder'=>'Veuillez saisir le lieu..', 'style'=>'width:300px')))
            ->add('image', FileType::class, array('data_class' => null,'label' => 'insérer une image','attr'=>array('style'=>'color:violet')))
            ->add('Valider',SubmitType::class,array('label'=> 'Valider','attr'=>array('class'=>'btn btn-primary')));

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\Clubs'
        ));
    }

    public function getBlockPrefix()
    {
        return 'userbundle_clubs';
    }
}
