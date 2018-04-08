<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class DemandesParentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('heureDebut', TimeType::class, array(
            'input'  => 'datetime',
            'widget' => 'choice',
        ))->add('heureFin', TimeType::class, array(
        'input'  => 'datetime',
        'widget' => 'choice',
    ))->add('dateDebut',\Symfony\Component\Form\Extension\Core\Type\DateType::class)
            ->add('dateFin',\Symfony\Component\Form\Extension\Core\Type\DateType::class)
            ->add('description', TextareaType::class)->add('Envoyer',SubmitType::class,array('label'=> 'Envoyer','attr'=>array('class'=>'btn btn-primary')));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\DemandesParent'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'userbundle_demandesparent';
    }


}
