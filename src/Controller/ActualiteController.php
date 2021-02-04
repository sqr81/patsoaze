<?php
namespace App\Controller;

use App\Entity\Actualite;
//use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\ActualiteRepository;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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
    private $actualiteRepository;

    public function __construct(ActualiteRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/actualites", name="actualite.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(): Response
    {
        $actualites = $this->repository->findAllById();
        return $this->render('actualites/index.html.twig', compact('actualites'));
    }

    /**
     * @Route("/actualites/{slug}-{id}", name="actualite.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Actualite $actualite
     * @param string $slug
     * @return Response
     */
    public function show(Actualite $actualite, string $slug):Response
    {
        if ($actualite->getSlug() !== $slug) {
            return $this->redirectToRoute('actualite.show', [
                'id' => $actualite->getId(),
                'slug' => $actualite->getSlug()
            ], 301);
        }


        $actualites = $this->repository->findLastThree();
        $actu = $this->repository->findLastSix();
        $banniere = $actualite->getCategorie();
        $categorie = $actualite->getCategorie();


        return  $this->render('actualites/show.html.twig', [
            'actualites' => $actualites,
            'actualite' => $actualite,
            'actu' => $actu,
            'banniere' => $banniere,
            'categorie' => $categorie,
            'current_menu' => 'actualites']);
    }
}
