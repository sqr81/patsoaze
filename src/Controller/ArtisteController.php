<?php

namespace App\Controller;

use App\Entity\Artiste;
use App\Repository\ArtisteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtisteController extends AbstractController

{

    /**
     * @var ArtisteRepository
     */
    private $repository;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(ArtisteRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route ("/artistes", name="artiste.index")
     * @return Response
     */
    public function index(): Response
    {
        $artistes = $this->repository->findAll();
        return $this->render('artistes/index.html.twig',[
            'artistes'=>$artistes,
        ]);

    }
}