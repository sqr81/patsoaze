<?php
namespace App\Controller;

use App\Repository\AquarelleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class HomeController extends AbstractController
{


    /**
     * @Route("/", name="home")
     * @param AquarelleRepository $repository
     * @return Response
     */
    public function index(AquarelleRepository $repository): Response
    {
        $aquarelles = $repository->findLatest();
        return $this->render('pages/home.html.twig', [
            'aquarelles'=>$aquarelles]);
    }
}