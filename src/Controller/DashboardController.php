<?php

namespace App\Controller;

use App\Controller\Admin\AquarelleCrudController;
use App\Controller\Admin\PhotoCrudController;
use App\Entity\Actualite;
use App\Entity\Admin;
use App\Entity\AlbumPhoto;
use App\Entity\Aquarelle;
use App\Entity\Photo;
use App\Repository\ActualiteRepository;
use App\Repository\AdminRepository;
use App\Repository\AlbumPhotoRepository;
use App\Repository\AquarelleRepository;
use App\Repository\PhotoRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardController extends AbstractDashboardController
{
    protected $adminRepository;
    protected $aquarelleRepository;
    protected $photoRepository;
    protected $albumPhotoRepository;
    protected $actualiteRepository;

    public function __construct(
        AdminRepository $adminRepository,
        AquarelleRepository $aquarelleRepository,
        PhotoRepository $photoRepository,
        AlbumPhotoRepository $albumPhotoRepository,
        ActualiteRepository $actualiteRepository
    )
    {
        $this->adminRepository = $adminRepository;
        $this->aquarelleRepository = $aquarelleRepository;
        $this->photoRepository = $photoRepository;
        $this->albumPhotoRepository = $albumPhotoRepository;
        $this->actualiteRepository = $actualiteRepository;

    }

    /**
     * @Route("/admin_754d2f", name="admin")
     * @Security("is_granted('ROLE_ADMIN')")
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function index(): Response
    {
        // redirect to some CRUD controller
//        return $this->redirect($routeBuilder->setController(AquarelleCrudController::class)->generateUrl());

        // you can also redirect to different pages depending on the current user
//        if ('jane' === $this->getUser()->getUsername()) {
//            return $this->redirect('...');
//        }

        // you can also render some template to display a proper Dashboard
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();
//        dd($routeBuilder);
        return $this->render('bundles/EasyAdminBundle/welcome.html.twig',[

                'countAllAdmins'=> $this->adminRepository->countAllAdmins(),
                'countAllAquarelles'=> $this->aquarelleRepository->countAllAquarelles(),
                'countAllActualites'=> $this->actualiteRepository->countAllActualites(),
                'countAllAlbumPhotos'=> $this->albumPhotoRepository->countAllAlbumPhotos(),
                'countAllPhotos'=> $this->photoRepository->countAllPhotos(),

                'aquarelles'=> $this->aquarelleRepository->findLatest(),
                'actualites' => $this->actualiteRepository->findLatest(),
                'albumPhotos'=> $this->albumPhotoRepository->findLatest(),
                'photos'=> $this->photoRepository->findLatest(),
                'admins'=> $this->adminRepository->findAll(),
            ]
        );
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
//        return $this->render('some/path/my-dashboard.html.twig');
    }

//Configuration du tableau de bord
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            // the name visible to end users
            ->setTitle('Dashboard Pat & Soaze')
            // you can include HTML contents too (e.g. to link to an image)
            ->setTitle('<img src="/uploads/images/divers/logo2.png"> Pat & Soaze: <span class="text-small">Photos et Aquarelles</span>')

            // the path defined in this method is passed to the Twig asset() function
            ->setFaviconPath('favicon.svg')

            // the domain used by default is 'messages'
            ->setTranslationDomain('my-custom-domain')

            // there's no need to define the "text direction" explicitly because
            // its default value is inferred dynamically from the user locale
            ->setTextDirection('ltr')
            ;
    }

    public function configureAssets(): Assets
    {
        return Assets::new()
            ->addCssFile('bundles/easyadmin/css/style.css');
    }

//    Configuration des menus du tableau de bord
    public function configureMenuItems(): iterable
    {
        return [
            //Menu avec sous menus
//            MenuItem::subMenu('Blog', 'fa fa-article')->setSubItems([
//                MenuItem::linkToCrud('Categories', 'fa fa-tags', Category::class),
//                MenuItem::linkToCrud('Posts', 'fa fa-file-text', BlogPost::class),
//                MenuItem::linkToCrud('Comments', 'fa fa-comment', Comment::class),
            MenuItem::linkToUrl('Visiter le site', 'fa fa-fighter-jet', '/'),
            MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home'),

//            MenuItem::section('Utilisateurs'),
            MenuItem::linkToCrud('Administrateurs', 'fa fa-user-secret', Admin::class)
                ->setQueryParameter('sortField', 'createdAt')
                ->setQueryParameter('sortDirection', 'DESC'),

//            MenuItem::section('Aquarelles'),
            MenuItem::linkToCrud('Aquarelles', 'fa fa-paint-brush', Aquarelle::class)
                ->setQueryParameter('sortField', 'createdAt')
                ->setQueryParameter('sortDirection', 'DESC'),

//            MenuItem::section('Actualités'),
            MenuItem::linkToCrud('Actualites', 'fa fa-newspaper-o', Actualite::class)
                ->setQueryParameter('sortField', 'createdAt')
                ->setQueryParameter('sortDirection', 'DESC'),

//            MenuItem::section('Albums photos'),
            MenuItem::linkToCrud('Albums photos', 'fas fa-image', AlbumPhoto::class)
                ->setQueryParameter('sortField', 'createdAt')
                ->setQueryParameter('sortDirection', 'DESC'),

//            MenuItem::section('Photos'),
            MenuItem::linkToCrud('Photos', 'fa fa-camera', Photo::class)
                ->setQueryParameter('sortField', 'createdAt')
                ->setQueryParameter('sortDirection', 'DESC'),

            MenuItem::section(),
            MenuItem::linkToLogout('Logout', 'fa fa-sign-out'),
        ];
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)
            ->setName($user->getUsername())
            ->setGravatarEmail($user->getUsername())
            ->displayUserAvatar(true)
            ;
    }

}