<?php
/**
 * Created by PhpStorm.
 * User: imen
 * Date: 22/03/2018
 * Time: 20:21
 */

namespace UserBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheMoyen extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('immatriculation',null,array('label'=> 'immatriculation','attr'=>array('class'=>'form-control', 'placeholder'=>'Recherche par immatriculation..', 'style'=>'width:300px')))
            ->add('Rechercher',SubmitType::class,array('label'=> ' ','attr'=>array('class'=>'btn btn-primary btn-group-right ti-search input-group-btn'))) ;
    }/**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\MoyensDeTransport'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'userbundle_produits';
    }
}