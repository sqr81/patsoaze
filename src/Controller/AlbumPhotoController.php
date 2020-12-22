<?php

namespace App\Controller;

use App\Entity\AlbumPhoto;
use App\Entity\Photo;
use App\Form\AlbumPhotoType;
use App\Repository\AlbumPhotoRepository;
use App\Repository\PhotoRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlbumPhotoController extends AbstractController
{
    /**
     * @var AlbumPhotoRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */

    private $em;
    public function __construct(AlbumPhotoRepository $repository, EntityManagerInterface $em)
    {

        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/albumPhoto", name="albumPhoto.index")
     */
    public function index()
    {
//        return $this->render('album_photo/index.html.twig', [
//            'controller_name' => 'AlbumPhotoController',
//
//        ]);
        $albumPhotos = $this->repository->findAll();
        $this->em->flush();
        return $this->render('albumPhoto/index.html.twig',[
            'albumPhotos' => $albumPhotos,]);

    }

    /**
     * @Route("/albumPhoto/{slug}-{id}", name="albumPhoto.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param AlbumPhoto $albumPhoto
     * @param Photo $photo
     * @param string $slug
     * @return Response
     */
    public function show(AlbumPhoto $albumPhoto, string $slug):Response
    {
        if ($albumPhoto->getSlug() !== $slug) {
            return $this->redirectToRoute('albumPhoto.show',[
                'id' => $albumPhoto->getId(),
                'slug' => $albumPhoto->getSlug(),
            ]);
        }
        return $this->render('albumPhoto/show.html.twig',[
            'albumPhoto'=>$albumPhoto,
//            'photo'=>$photo,
            'current_menu' => 'albumPhoto',

            ]);

    }

    /**
     * @param AlbumPhoto $albumPhoto
     * @param string $slug
     * @return Response
     */
    public function indexPhotosByAlbum(AlbumPhoto $albumPhoto, string $slug): Response
    {
        if ($albumPhoto->getSlug() !== $slug) {
            return $this->redirectToRoute('albumPhoto.show', [
                'id' => $albumPhoto->getId(),
                'slug' => $albumPhoto->getSlug(),
            ], 301);
        }

        $photos = $this->getDoctrine()
            ->getRepository(PhotoRepository::class)
            ->findPhotosByAlbum($albumPhoto);

//        foreach ($userData as $user) {
//            $user->getTopics();
//        }

        return $this->render('albumPhoto/show.html.twig', [
            'albumPhoto' => $albumPhoto,
            'photos' => $photos,
//            'user' => $user,
        ]);
    }

//    /**
//     * @return \Symfony\Component\HttpFoundation\RedirectResponse
//     * @param Request $request
//     * @return Response
//     */
//    public function new(Request $request)
//    {
//        /**
//         * @Route("/albumphoto/new", name="albumphoto.new")
//         * @param Request $request
//         * @return Response
//         */
//
//        $albumPhoto = new AlbumPhoto();
//        $form = $this->createForm(AlbumPhotoType::class, $albumPhoto);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            // On récupère les images transmises
//            $images = $form->get('images')->getData();
//
//            // On boucle sur les images
//            foreach($images as $image){
//                // On génère un nouveau nom de fichier
//                $fichier = md5(uniqid()).'.'.$image->guessExtension();
//
//                // On copie le fichier dans le dossier uploads
//                $image->move(
//                    $this->getParameter('images_directory'),
//                    $fichier
//                );
//
//                // On crée l'image dans la base de données
//                $img = new Photo();
//                $img->setNom($fichier);
//                $albumPhoto->addPhoto($img);
//            }
//
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($albumPhoto);
//            $entityManager->flush();
//
//            return $this->redirectToRoute('album_photo');
//        }
//        return $this->redirectToRoute('albumphoto.new');
//
//
//    }



}
