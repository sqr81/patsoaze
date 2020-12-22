<?php

namespace App\Controller\Admin;

use App\Entity\AlbumPhoto;
use App\Form\PhotoType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class AlbumPhotoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AlbumPhoto::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDateFormat('dd-mm-yyyy-mm')
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des albums')

            ;
    }

    public function configureFields(string $pageName): iterable
    {
//        return [
//            IntegerField::new('id')->onlyOnIndex(),
//            TextField::new('nom'),
//            TextEditorField::new('description'),
//            NumberField::new('nombre_photos'),
////            DateTimeField::new('created_at: '),
//            AssociationField::new('photo'),
////            AssociationField::new('admin')
////            ImageField::new('imageFile'),
//        ];
        //pour pouvoir afficher les photos
        $imageField = ImageField::new('imageFile')
            ->setFormType(VichImageType::class)
            ->setLabel('image');
        //pour pouvoir afficher les photos
        $image = ImageField::new('image')
            ->setBasePath("/uploads/images/photos")
            ->setLabel('Image');


        $fields = [
            IntegerField::new('id', 'identifiant')->onlyOnIndex(),
            TextField::new('nom')->setTemplatePath('bundles/EasyAdminBundle/field_custom.html.twig'),
            TextEditorField::new('description'),

//            AssociationField::new('admin'),
//            AssociationField::new('photo'),
            DateTimeField::new('created_at'),
            CollectionField::new('photo')
                ->setEntryType(PhotoType::class)
                ->setFormTypeOption('by_reference',false)
                ->onlyOnForms(),
//            CollectionField::new('photo')->onlyOnDetail(),
        ];

        //pour pouvoir afficher les photos
        if ($pageName === Crud::PAGE_INDEX || $pageName === Crud::PAGE_DETAIL) {
            $fields[] = $image;
        } else {
            $fields[] = $imageField;
        }
        return $fields;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->add(Crud::PAGE_INDEX,'detail');
    }
}
