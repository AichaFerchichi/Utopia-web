<?php

namespace UserBundle\Form;



use Doctrine\DBAL\Types\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom',TextType::class)
            ->add('prenom',TextType::class)
            ->add('tel',IntegerType::class)
            ->add('email',EmailType::class)
            ->add('text',TextType::class)
            ->add('valider',SubmitType::class);

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\Mail'
        ));
    }

    public function getBlockPrefix()
    {
        return 'userbundle_mail';
    }
}
