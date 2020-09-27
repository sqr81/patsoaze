<?php

namespace App\Controller\Admin;

use App\Entity\AlbumPhoto;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

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
        return [
            IntegerField::new('id')->onlyOnIndex(),
            TextField::new('nom'),
            TextEditorField::new('description'),
            NumberField::new('nombre_photos'),
//            DateTimeField::new('created_at: '),
            AssociationField::new('photo'),
//            AssociationField::new('admin')
//            ImageField::new('imageFile'),
        ];
    }

}
