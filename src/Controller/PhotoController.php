<?php
namespace App\Controller;

use App\Entity\Photo;
use App\Repository\PhotoRepository;
//use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function index(Request $request, PaginatorInterface $paginator):Response
    {
        $photos = $this->repository->findAll();
        $this->em->flush();
        //Pagination
        $photos = $pagination = $paginator->paginate(
            $photos, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );

        return  $this->render('photos/index.html.twig',[
            'photos' => $photos,]
        );

    }
    function photoNext(&$vars) {
        static $counter = 0;
        $vars['counter'] = $counter++;
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

        $id = $photo->getId();
        $photoSuivante = $this->getDoctrine()
            ->getRepository(Photo::class)
            ->photoSuivante($id);
        $photos = $this->repository->findAll();

        $id = !empty($_POST['id']) ? $_POST['id'] : NULL;

        return  $this->render('photos/show.html.twig', [
            'photo' => $photo,
            'photos' =>$photos,
            'photoSuivante' => $photoSuivante,
            'id' => $id,
            'current_menu' => 'photos']);

    }


}