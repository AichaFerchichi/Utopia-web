<?php

namespace UserBundle\Form;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;


class modifierType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('adresse',null,array('attr' =>array('class'   => 'form-control')))->add('age',null,array('attr' =>array('class'   => 'form-control')))
            ->add('sexe',ChoiceType::class, array(
                'choices'  => array(
                    'Sexe' => array(
                        'Homme' => 'Homme',
                        'Femme'=> 'Femme',

                    ),
                ),
            ))->add('description', TextareaType::class)->add('numtel',null,array('attr' =>array('class'   => 'form-control')))

            ->add('experience',ChoiceType::class, array(
                'choices'  => array(
                    'Votre experience' => array(
                        'Sans experience' => 'Sans experience',
                        '1-2'=> '1-2',
                        '3-4' => '3-4',
                        '4-5' => '4-5',
                    ),
                ),
            ))->add('lieu_baby',ChoiceType::class,array('choices'=>array(
                'Votre lieu de garde' => array(
                    'Pas de preferences'=>'Pas de preferences',
                    'A mon domicile'=>'A mon domicile',
                    'Au domicile de la famille'=>'Au domicile de la famille',

                ))))->add('dispo',TextareaType::class)->add('image', FileType::class, array('data_class' => null, 'label' => 'insérer une image'))->add('Valider',SubmitType::class,array('label'=> 'Valider','attr'=>array('class'=>'btn btn-primary')));

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