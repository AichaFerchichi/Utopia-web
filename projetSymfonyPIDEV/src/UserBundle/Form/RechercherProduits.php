<?php

namespace UserBundle\Form;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercherProduits extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('categorie',null,array('label'=> 'categorie','attr'=>array('class'=>'form-control', 'placeholder'=>'Recherche par catégorie..', 'style'=>'width:300px')))
            ->add('Rechercher',SubmitType::class,array('label'=> ' ','attr'=>array('class'=>'btn btn-primary btn-group-right ti-search input-group-btn'))) ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\Produits'
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
