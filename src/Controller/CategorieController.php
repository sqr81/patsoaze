<?php
namespace App\Controller;


use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{
    /**
     * @var CategorieRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;
    private $categorieRepository;

    public function __construct(CategorieRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }


    /**
     * @Route("/categories", name="categorie.index")
     * @return Response
     */
    public function index(): Response
    {
        $categories = $this->repository->findAll();
        return $this->render('categories/index.html.twig', compact('categories'));
//        'countAllCategories'=> $this->categorieRepository->countAllCategories();
    }


    /**
     * @Route("/categorie/{slug}-{id}", name="categorie.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Categorie $categorie
     * @param string $slug
     * @return Response
     */
    public function show (Categorie $categorie, string $slug):Response
    {
        if ($categorie->getSlug() !== $slug) {
            return $this->redirectToRoute('categorie.show', [
                'id' => $categorie->getId(),
                'slug' => $categorie->getSlug()
            ], 301);
        }

        $categories = $this->repository->findAll();
//        $categorie = $this->repository->findActuByCategorie($categorie);
        return  $this->render('categories/show.html.twig',[
            'categories'=>$categories,
            'actubycategorie' => $categorie,

        ]);




    }
}
