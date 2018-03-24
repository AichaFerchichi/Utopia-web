<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class CovoituragesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('depart',ChoiceType::class,array('choices'=>array(
                'Tunis'=>'Tunis',
                'Ariana'=>'Ariana',
                'Marsa'=>'Marsa',
                'Ben Arouss'=>'Ben Arouss',
                'Beja'=>'Beja',
            )))
            ->add('datedepart',DateType::class,array('placeholder'=>array('year'=>'Année','month'=>'Mois','day'=>'Jour')))
            ->add('heured')
            ->add('destination',ChoiceType::class,array('choices'=>array(
                'Tunis'=>'Tunis',
                'Ariana'=>'Ariana',
                'Marsa'=>'Marsa',
                'Ben Arouss'=>'Ben Arouss',
                'Beja'=>'Beja',
            )))
            ->add('datearrive',DateType::class,array('placeholder'=>array('year'=>'Année','month'=>'Mois','day'=>'Jour')))
            ->add('heurea')
            ->add('nbrePlaceDispo')
        ->add('Valider',SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\Covoiturages'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'userbundle_covoiturages';
    }


}
