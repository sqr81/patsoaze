<?php

namespace App\Controller\Admin;

use App\Entity\Aquarelle;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class AquarelleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Aquarelle::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDateFormat('dd-mm-yyyy-mm')
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des aquarelles')

            ;
    }

    public function configureFields(string $pageName): iterable
    {
        //pour pouvoir afficher les photos
        $imageField = ImageField::new('imageFile')
            ->setFormType(VichImageType::class)
            ->setLabel('image');
        //pour pouvoir afficher les photos
        $image = ImageField::new('image')
            ->setBasePath("/uploads/images/aquarelles")
            ->setLabel('Image');


         $fields = [
            IntegerField::new('id', 'identifiant')->onlyOnIndex(),
            TextField::new('nom')->setTemplatePath('bundles/EasyAdminBundle/field_custom.html.twig'),
            TextEditorField::new('description'),
            MoneyField::new('prix')->setCurrency('EUR'),
            BooleanField::new('vendue'),
            AssociationField::new('admin'),
             DateTimeField::new('created_at'),
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
