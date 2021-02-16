<?php
namespace App\Controller;

use App\Repository\ActualiteRepository;
use App\Repository\AquarelleRepository;
use App\Repository\PhotoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Vich\UploaderBundle\Form\Type\VichImageType;

class HomeController extends AbstractController
{

    public function __construct(PhotoRepository $repository, EntityManagerInterface $em)
    {

        $this->repository = $repository;
        $this->em = $em;

    }
    /**
     * @Route("/", name="home")
     * @param AquarelleRepository $repository
     * @param PhotoRepository $photoRepository
     * @param ActualiteRepository $actualiteRepository
     * @return Response
     */
    public function index(AquarelleRepository $repository, PhotoRepository $photoRepository, ActualiteRepository $actualiteRepository): Response
    {

        $aquarelles = $repository->findLatest();
        $photos = $photoRepository->findLatest();
        $actualites =$actualiteRepository->findLastTwo();
        return $this->render('pages/home.html.twig', [
            'aquarelles'=>$aquarelles,
            'photos'=>$photos,
            'actualites'=>$actualites,

        ]);
    }
}