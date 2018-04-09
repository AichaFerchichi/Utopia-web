<?php

namespace UserBundle\Form;

use blackknight467\StarRatingBundle\Form\RatingType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class NotesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('rating', RatingType::class, [

        ])

            ->setMethod('GET')
            ->add('Valider',SubmitType::class, array(
                'attr'   =>  array(
                    'class' => 'btn btn-success', 'style' => 'font-size:12px')
            )) ;


    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\Notes'
        ), [
            'attr' => [
                'class' => 'rating',
            ],
            'scale' => 1,
            'stars' => 5,
        ]);


    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'userbundle_notes';
    }


}
