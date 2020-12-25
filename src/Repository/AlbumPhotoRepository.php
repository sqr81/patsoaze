<?php

namespace App\Repository;

use App\Entity\AlbumPhoto;
use App\Entity\Photo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\From;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method AlbumPhoto|null find($id, $lockMode = null, $lockVersion = null)
 * @method AlbumPhoto|null findOneBy(array $criteria, array $orderBy = null)
 * @method AlbumPhoto[]    findAll()
 * @method AlbumPhoto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlbumPhotoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AlbumPhoto::class);
    }

    /**
     * @return AlbumPhoto[]
     */
    public function findLatest(): array
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param AlbumPhoto $albumPhoto
     * @return int|mixed|string
     */
    public function findPhotosByAlbum(AlbumPhoto $albumPhoto)
    {
        $qb = $this->createQueryBuilder('a')
            ->innerJoin('a.album_photo', 'c')
            ->andWhere('a.album_photo = :name')
            ->setParameter('albumPhoto', $albumPhoto);
        return $qb
            ->orderBy('a.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }
//return $this->createQueryBuilder('p');
//$query = $em->createQuery("SELECT photo.nom AS photo FROM photo INNER JOIN album_photo ON photo.album_photo_id = album_photo.id");

//    /**
//     * @param Photo $photo
//     * @return AlbumPhoto[]
//     * @throws \Doctrine\ORM\NonUniqueResultException
//     */
//    public function findPhotoByAlbum(Photo $photo):array
//    {
//        $qb = $this->createQueryBuilder('a');
////        $qb ->select('photo.nom')
////            ->from('photo', 'p')
////            ->innerJoin('a.album_photo', 'album')
//////            ->on ('photo.album_photo_id = album_photo.id')
////            ->addSelect('album');
////            ->where($qb->expr()->eq('acti.degre', $qb->expr()->literal(1)))
////            ->andWhere($qb->expr()->eq('acti.forme', $qb->expr()->literal(1)))
////            ->andWhere($qb->expr()->eq('a.groupe', ':gr'))
////            ->setParameters(array('gr' => $groupe));
//
//        return $qb->getQuery()->getOneOrNullResult();
//    }

    /**
     * @return int|mixed|string
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function countAllAlbumPhotos()
    {
        $queryBuilder = $this->createQueryBuilder('a');
        $queryBuilder->select('COUNT(a.id)as value');

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }


//    /**
//     * @Route("/photos/{slug}-{id}", name="photo.show", requirements={"slug": "[a-z0-9\-]*"})
//     * @param Photo $photo
//     * @param string $slug
//     * @return Response
//     */
//    public function show(Photo $photo, string $slug):Response
//    {
//        if ($photo->getSlug() !== $slug) {
//            return $this->redirectToRoute('photo.show', [
//                'id' => $photo->getId(),
//                'slug' => $photo->getSlug()
//            ], 301);
//        }
//
//        return  $this->render('photos/show.html.twig', [
//            'photo' => $photo,
//            'current_menu' => 'photos']);
//    }


    // /**
    //  * @return AlbumPhoto[] Returns an array of AlbumPhoto objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AlbumPhoto
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */



}
