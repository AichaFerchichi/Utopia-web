<?php

namespace UserBundle\Form;


use Doctrine\DBAL\Types\IntegerType;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CheckQuizType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('en1',CheckboxType::class, array(
            'label'    => 'oui',
            'required' => false,
        ))
            ->add('en2',CheckboxType::class, array(
                'label'    => 'oui',
                'required' => false,
            ))
            ->add('en3',CheckboxType::class, array(
                'label'    => 'oui',
                'required' => false,
            ))
            ->add('valider',SubmitType::class,array('label'=> 'Valider','attr'=>array('class'=>'btn btn-primary')));
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\CheckQuiz'
        ));
    }

    public function getBlockPrefix()
    {
        return 'userbundle_checkquiz';
    }
}
