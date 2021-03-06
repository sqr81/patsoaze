<?php

namespace App\Repository;

use App\Entity\Photo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Photo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Photo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Photo[]    findAll()
 * @method Photo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhotoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Photo::class);
    }

    /**
     * @return Photo[]
     */
    public function findLatest(): array
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.id', 'DESC')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return int|mixed|string
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function countAllPhotos()
    {
        $queryBuilder = $this->createQueryBuilder('p');
        $queryBuilder->select('COUNT(p.id) as value');

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }

    public function findAlbumByPhotos(Categories $category)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.topic_cat = :category')
            ->setParameter('category', $category)
            ->innerJoin('t.topic_cat', 'c')
            ->addSelect('c.cat_name')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param int $id
     * @return Photo[]
     */
    public function photoSuivante(int $id):array
    {
        $entityManager = $this->getEntityManager();
//        création de la demande
        $query = $entityManager->createQuery(
            'SELECT suivant
            FROM App\Entity\Photo suivant
            WHERE suivant.id > :id 
            ORDER BY suivant.id ASC'
        )
            ->setParameter('id', $id)
            ->setMaxResults(1);

        return $query->getResult();

    }

    /**
     * @param int $id
     * @return array
     */
    public function photoPrecedente(int $id):array
    {
        $entityManager = $this->getEntityManager();
        //        création de la demande
        $query = $entityManager->createQuery(
            'SELECT precedent
            FROM App\Entity\Photo precedent
            WHERE precedent.id < :id
            ORDER BY precedent.id DESC'

        )
            ->setParameter('id', $id)
            ->setMaxResults(1);
        return $query->getResult();
    }

    // /**
    //  * @return Photo[] Returns an array of Photo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Photo
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
