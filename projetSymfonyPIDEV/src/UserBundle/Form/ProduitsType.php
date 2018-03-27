<?php

namespace UserBundle\Form;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom',null,array('label'=> 'nom','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus', 'placeholder'=>'Veuillez saisir le nom..', 'style'=>'width:300px')))
            ->add('categorie',ChoiceType::class,array('choices'=>array(
                'Jouets'=>'Jouets',
                'Vêtements'=>'Vêtements',
                'Fournitures'=>'Fournitures'
            )))
            ->add('prixProduit',null,array('label'=> 'prixProduit','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus','placeholder'=>'Veuillez saisir le prix..')))
            ->add('description',null,array('label'=> 'description','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus','placeholder'=>'Veuillez saisir la description..')))
            ->add('image', FileType::class, array('data_class' => null, 'label' => 'insérer une image'))
            ->add('quantite',null,array('label'=> 'quantite','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus','placeholder'=>'Veuillez saisir la quantité..')))
            ->add('Valider',SubmitType::class,array('label'=> 'Valider','attr'=>array('class'=>'btn btn-primary')));
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
