<?php
namespace App\Controller;

use App\Entity\Photo;
use App\Repository\PhotoRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PhotoController extends AbstractController
{
    /**
     * @var PhotoRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(PhotoRepository $repository, EntityManagerInterface $em)
    {

        $this->repository = $repository;
        $this->em = $em;
    }
    
    /**
     * @Route("/photos", name="photo.index")
     * @return Response
     */
    public function index():Response
    {
        $photos = $this->repository->findAll();
        $this->em->flush();
        return  $this->render('photos/index.html.twig',[
            'photos' => $photos,]
        );

    }

    /**
     * @Route("/photos/{slug}-{id}", name="photo.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Photo $photo
     * @param string $slug
     * @return Response
     */
    public function show(Photo $photo, string $slug):Response
    {
        if ($photo->getSlug() !== $slug) {
            return $this->redirectToRoute('photo.show', [
                'id' => $photo->getId(),
                'slug' => $photo->getSlug()
            ], 301);
        }

        return  $this->render('photos/show.html.twig', [
            'photo' => $photo,
            'current_menu' => 'photos']);
    }

}