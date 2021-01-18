<?php

namespace App\Controller\Admin;

use App\Entity\Photo;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PhotoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Photo::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDateFormat('dd-mm-yyyy-mm')
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des photos')
            ->overrideTemplate('crud/edit','bundles/EasyAdminBundle/custom/crud_edit_custom.html.twig')
            ;
    }
    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */

    public function configureFields(string $pageName): iterable
    {
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
            AssociationField::new('albumPhoto'),
            AssociationField::new('admin'),
            DateTimeField::new('created_at')
                ->setFormat('EEEE d MMMM yyyy, HH:mm')
        ];
        //pour pouvoir afficher les photos
        if ($pageName === Crud::PAGE_INDEX || $pageName === Crud::PAGE_DETAIL) {
            $fields[] = $image;
        } else {
            $fields[] = $imageField;
        }
        return $fields;
    }
}
