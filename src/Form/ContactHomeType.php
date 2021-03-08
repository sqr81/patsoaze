<?php

namespace App\Form;

use EasyCorp\Bundle\EasyAdminBundle\Form\Type\TextEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactHomeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class,[
                'label' => 'Votre e-mail',
                'attr'=> [
                    'class' => 'form-control'
                ]
            ])
            ->add('nom', TextType::class, [
                'label' => 'Votre nom',
                'attr'=> [
                    'class' => 'form-control'
                ]
            ])
            ->add('message', TextEditorType::class, [
                'label' => 'Votre message'
            ])
//            ->add('telephone', TextEditorType::class, [
//                'label' => 'Votre téléphone'
//            ])
            ->add('envoyer', SubmitType::class,[
                'attr'=> [
                    'class' => 'btn-primary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
