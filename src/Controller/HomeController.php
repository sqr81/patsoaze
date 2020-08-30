<?php
namespace App\Controller;

use App\Repository\AquarelleRepository;
use App\Repository\PhotoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Vich\UploaderBundle\Form\Type\VichImageType;

class HomeController extends AbstractController
{


    /**
     * @Route("/", name="home")
     * @param AquarelleRepository $repository
     * @param PhotoRepository $photoRepository
     * @return Response
     */
    public function index(AquarelleRepository $repository, PhotoRepository $photoRepository): Response
    {

        $aquarelles = $repository->findLatest();
        $photos = $photoRepository->findLatest();
        return $this->render('pages/home.html.twig', [
            'aquarelles'=>$aquarelles,
            'photos'=>$photos,

        ]);
    }
}