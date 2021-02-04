<?php
namespace App\Controller;

use App\Entity\Aquarelle;
use App\Repository\AquarelleRepository;
//use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AquarelleController extends AbstractController
{
    /**
     * @var AquarelleRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(AquarelleRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/aquarelles", name="aquarelle.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $aquarelles = $this->repository->findAll();
        return $this->render('aquarelles/index.html.twig', compact('aquarelles'));
    }

    /**
     * @Route("/aquarelles/{slug}-{id}", name="aquarelle.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Aquarelle $aquarelle
     * @param string $slug
     * @return Response
     */
    public function show(Aquarelle $aquarelle, string $slug): Response
    {
        if ($aquarelle->getSlug() !== $slug) {
            return $this->redirectToRoute('aquarelle.show', [
                'id' => $aquarelle->getId(),
                'slug' => $aquarelle->getSlug(),
            ], 301);
        }
        return $this->render('aquarelles/show.html.twig', [
            'aquarelle' => $aquarelle,
            'current_menu' => 'aquarelles']);
    }

//    /**
//     * @Route("/aquarelles/{slug}-{id}", name="aquarelle.show", requirements={"slug": "[a-z0-9\-]*"})
//     * @param Aquarelle $aquarelle
//     * @param string $slug
//     * @return Response
//     */
//    public function aquarelleVendue(aquarelle $aquarelle, string $slug): Response
//    {
//        $aquarelleVendue = $aquarelle->getVendue();
//        if ($aquarelleVendue == 1) {
//            echo 'vendue';
//        }
//        else if ($aquarelleVendue == 0) {
//            echo 'à vendre';
//        }
//
//        return $this->render('aquarelles/show.html.twig', [
//            'aquarelle' => $aquarelle,
//            'aquarelleVendue' => $aquarelleVendue,
//
//        ]);
//
//
//
//
//    }

}