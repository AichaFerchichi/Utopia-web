<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 19/02/2018
 * Time: 16:23
 */

namespace FrontBundle\Form;
use blackknight467\StarRatingBundle\Form\RatingType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RatingForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('rating', RatingType::class, [
            'label' => 'Rating',
        ])

            ->setMethod('GET')
            ->add('Avis',SubmitType::class, array(
                'attr'   =>  array(
                    'class'   => 'btn btn-success')
            ));
}}