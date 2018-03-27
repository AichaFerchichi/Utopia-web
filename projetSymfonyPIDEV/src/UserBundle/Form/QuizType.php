<?php

namespace UserBundle\Form;


use Doctrine\DBAL\Types\IntegerType;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuizType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('theme',null,array('label'=> 'Theme','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus', 'placeholder'=>'Veuillez saisir theme..', 'style'=>'width:300px')))
            ->add('question',null,array('label'=> 'Question','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus','placeholder'=>'Veuillez saisir la question..')))
            ->add('rep1',null,array('label'=> 'Réponse1','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus','placeholder'=>'Veuillez saisir la réponse 1..')))
            ->add('rep2',null,array('label'=> 'Réponse2','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus','placeholder'=>'Veuillez saisir la réponse 2..')))
            ->add('rep3',null,array('label'=> 'Réponse3','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus','placeholder'=>'Veuillez saisir la réponse 3..')))
            ->add('image', FileType::class, array('data_class' => null,'label' => 'insérer une image','attr'=>array('style'=>'color:violet')))
            ->add('repC',null,array('label'=> 'Programme','attr'=>array('class'=>'text-muted m-b-15 f-s-12 form-control input-focus','placeholder'=>'Veuillez saisir la réponse correcte..')))

            ->add('Valider',SubmitType::class,array('label'=> 'Valider','attr'=>array('class'=>'btn btn-primary')));
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\Quiz'
        ));
    }

    public function getBlockPrefix()
    {
        return 'userbundle_quiz';
    }
}
