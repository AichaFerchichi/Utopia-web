<?php

namespace UserBundle\Form;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PromotionsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('pourcentage',ChoiceType::class,array('choices'=>array(
            '10'=>'10',
            '20'=>'20',
            '25'=>'25',
            '30'=>'30',
            '50'=>'50',
            '75'=>'75',
            '80'=>'80'
        )))->add('dateDebut', DateType::class, [
            'widget' => 'single_text'
        ],null,array('label'=> 'dateDebut','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus' , 'style'=>'width:400px')))
            ->add('dateFin', DateType::class, [
                'widget' => 'single_text'
            ],null,array('label'=> 'dateFin','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus', 'style'=>'width:400px')))


            ->add('Valider',SubmitType::class,array('label'=> 'Valider','attr'=>array('class'=>'btn btn-primary')));;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\Promotions'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'userbundle_promotions';
    }


}
