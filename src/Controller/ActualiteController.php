<?php
namespace App\Controller;

use App\Entity\Actualite;
use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\ActualiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ActualiteController extends AbstractController
{
    /**
     * @var ActualiteRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(ActualiteRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/actualites", name="actualite.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $actualites = $this->repository->findAll();
        return $this->render('actualites/index.html.twig', compact('actualites'));
    }
}
