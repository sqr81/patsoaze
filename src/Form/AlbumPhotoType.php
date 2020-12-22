<?php

namespace App\Form;

use App\Entity\AlbumPhoto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlbumPhotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('nombre_photos')
            ->add('created_at')
            //ajout du champ "images" dans le formulaire
                //il n est pas lié à la bbd (mapped à false)
            ->add('images', FileType::class,[
                'label' => false,
                'multiple' => true,
                'mapped' => true,
                'required' => false
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AlbumPhoto::class,
        ]);
    }
}
