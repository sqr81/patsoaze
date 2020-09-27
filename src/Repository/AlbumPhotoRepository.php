<?php

namespace App\Repository;

use App\Entity\AlbumPhoto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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
     * @return int|mixed|string
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function countAllAlbumPhotos()
    {
        $queryBuilder = $this->createQueryBuilder('a');
        $queryBuilder->select('COUNT(a.id)as value');

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }
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
