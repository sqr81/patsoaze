<?php

namespace App\Controller;

use App\Entity\Artiste;
use App\Repository\ArtisteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
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
     * @var ObjectManager
     */
    private $em;

    public function __construct(ArtisteRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route ("/artistes/indexpeintre", name="artiste_peintre.index")
     * @return Response
     */
    public function indexPeintre(): Response
    {

        $artistes = $this->repository->findAll();
        return $this->render('artistes/indexpeintre.html.twig',[
            'artistes'=>$artistes,

        ]);

    }

    /**
     * @Route ("/artistes/indexphotographe", name="artiste_photographe.index")
     * @return Response
     */
    public function indexPhotographe(): Response
    {

        $artistes = $this->repository->findAll();
        return $this->render('artistes/indexphotographe.html.twig',[
            'artistes'=>$artistes,

        ]);

    }
}