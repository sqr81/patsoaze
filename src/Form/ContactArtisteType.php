<?php

namespace App\Form;

use EasyCorp\Bundle\EasyAdminBundle\Form\Type\TextEditorType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactArtisteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'disabled' => true,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('nom', TextType::class, [
                'label' => 'Votre nom',
                'attr'=> [
                    'class' => 'form-control'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Votre e-mail',
                'attr'=> [
                    'class' => 'form-control'
                ]
            ])
            ->add('message', TextEditorType::class, [
                'label' => 'Votre message'
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
