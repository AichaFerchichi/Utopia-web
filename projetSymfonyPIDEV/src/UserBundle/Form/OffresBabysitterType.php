<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;


class OffresBabysitterType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('adresse')->add('dateNaissance')->add('sexe',ChoiceType::class,array('choices'=>array(
            'Femme'=>'Femme',
            'Homme'=>'Homme',
        )))->add('description', TextareaType::class)->add('numtel')->add('experience',ChoiceType::class,array('choices'=>array(
            '1-2'=>'1-2',
            '3-4'=>'3-4',
            '4-5'=>'4-5',
            'Sans experience'=>'Sans experience',
        )))->add('lieu_baby',ChoiceType::class,array('choices'=>array(
            'Pas de preferences'=>'Pas de preferences',
            'A mon domicile'=>'A mon domicile',
            'Au domicile de la famille'=>'Au domicile de la famille',

        )))->add('fumeuse', CheckboxType::class, array(
            'label'    => 'Show this entry publicly?',
            'required' => false,
        ))->add('enfant')->add('conduite')->add('agregation')->add('dispo')->add('image')->add('video');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\OffresBabysitter'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'userbundle_offresbabysitter';
    }


}
