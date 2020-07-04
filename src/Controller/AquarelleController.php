<?php
namespace App\Controller;

use App\Entity\Aquarelle;
use App\Repository\AquarelleRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
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

    public function __construct(AquarelleRepository $repository,EntityManagerInterface $em)
    {

        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/aquarelles", name="aquarelle.index")
     * @return Response
     */
    public function index():Response
    {
//        $aquarelle = new Aquarelle();
//        $aquarelle->setNom('Coucher de soleil')
//            ->setDescription('coucher de soleil sur la pointe du Raz')
//            ->setPrix(150);
//        $em = $this->getDoctrine()->getManager();
//        $em->persist($aquarelle);
//        $em->flush();
        $aquarelle = $this->repository->findAll();
        $this->em->flush();
        return  $this->render('aquarelles/index.html.twig', [ 'current_menu' => 'aquarelles']);

    }

    /**
     * @Route("/aquarelles/{slug}-{id}", name="aquarelle.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Aquarelle $aquarelle
     * @param string $slug
     * @return Response
     */
    public function show(Aquarelle $aquarelle, string $slug):Response
    {
        if ($aquarelle->getSlug() !== $slug) {
            return $this->redirectToRoute('aquarelle.show', [
                'id' => $aquarelle->getId(),
                'slug' => $aquarelle->getSlug()
            ], 301);
        }

        return  $this->render('aquarelles/show.html.twig', [
            'aquarelle' => $aquarelle,
            'current_menu' => 'aquarelles']);
    }
}

