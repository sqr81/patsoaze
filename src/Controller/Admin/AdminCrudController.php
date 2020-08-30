<?php

namespace App\Controller\Admin;

use App\Entity\Admin;
use App\Repository\AdminRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Vich\UploaderBundle\Form\Type\VichImageType;

class AdminCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Admin::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDateFormat('dd-mm-yyyy-mm')
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des administrateurs')

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
            ->setBasePath("/uploads/images/admins")
            ->setLabel('Image');
        $fields =  [
            IntegerField::new('id', 'identifiant')->onlyOnIndex(),
            TextField::new('username')->setTemplatePath('bundles/EasyAdminBundle/field_custom.html.twig'),
            TextField::new('email'),
//            IntegerField::new('roles'),
//            IntegerField::new('password'),
        ];
        //pour pouvoir afficher les photos
        if ($pageName === Crud::PAGE_INDEX || $pageName === Crud::PAGE_DETAIL) {
            $fields[] = $image;
        } else {
            $fields[] = $imageField;
        }
        return $fields;
//        return [
//            IntegerField::new('id', 'identifiant')->onlyOnIndex(),
//            TextField::new('username')->setTemplatePath('bundles/EasyAdminBundle/field_custom.html.twig'),
//            TextField::new('email'),
//            ImageField::new('imageFile')
//            ->setFormType(VichImageType::class)
//            ->setLabel('image'),
//        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        $linkExterne = Action::new('linkExterne', 'Facebook', 'fa fa-facebook-official')
            ->linkToUrl("https://www.facebook.com/")
            ->setHtmlAttributes([
                'target' => '_blank'
            ])
            ->addCssClass('btn btn-primary')
        ;

        $detailAdmin = Action::NEW('detailAdmin', 'Détail', 'fa fa-user')
            ->linkToCrudAction(Crud::PAGE_DETAIL)
            ->addCssClass('btn btn-info')
        ;

        $statistic = Action::NEW('statistic', 'Stat admin','fa fa-bar-chart')
            ->addCssClass('btn btn-primary')
            ->linkToRoute('statistic', function(Admin $entity){
                return [
                    'id'=>$entity->getId()
                ];
            });


        return $actions
//            ->setPermission(Action::DELETE, 'ROLE-ADMIN');
        ->add(Crud::PAGE_INDEX, $linkExterne)
        ->add(Crud::PAGE_INDEX, $detailAdmin)
        ->add(Crud::PAGE_INDEX,$statistic);
    }


    /**
     * @Route(path="/admin_754d2f/admin/statistic", name="statistic")
     * @param Request $request
     * @param AdminRepository $adminRepository
     * @return Response
     * @throws \Exception
     */
    public function statistic(Request $request, AdminRepository $adminRepository) {
        $id = $request->query->get('id');
        $admin = $adminRepository->find($id);

        $counterView = [];
        $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi'];

        foreach ($days as $day) {
            array_push($counterView, random_int(1, 10));
        }

        return $this->render('bundles/EasyAdminBundle/statistics_admin.html.twig', [
            'admin' => $admin,
            'crudAction' => 'index',
            'counterView' => $counterView,
            'dataName' => $days
        ]);
    }
}
