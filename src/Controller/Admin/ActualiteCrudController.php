<?php

namespace App\Controller\Admin;

use App\Entity\Actualite;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ActualiteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Actualite::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDateFormat('EEEE d MMMM yyyy, HH:mm')
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des actualités')

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
            ->setBasePath("/uploads/images/actualites")
            ->setLabel('Image');

        $fields = [
            IntegerField::new('id', 'identifiant')->onlyOnIndex(),
            TextField::new('titre')->setTemplatePath('bundles/EasyAdminBundle/field_custom.html.twig'),/*---customise le champ---*/
//            TextField::new('slug'),
            TextEditorField::new('description'),
            DateTimeField::new('created_at')
                ->setFormat('EEEE d MMMM yyyy, HH:mm'),

            ChoiceField::new('categorie')
                ->allowMultipleChoices('multiple')
                ->setChoices(['exposition' =>0, 'photo'=>1, 'aquarelle'=>2, 'divers'=>3 ]),


        ];

        //pour pouvoir afficher les photos
        if ($pageName === Crud::PAGE_INDEX || $pageName === Crud::PAGE_DETAIL) {
            $fields[] = $image;
        } else {
            $fields[] = $imageField;
        }

        return $fields;

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
}
