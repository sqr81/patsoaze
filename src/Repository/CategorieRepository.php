<?php

namespace App\Repository;

use App\Entity\Categorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Categorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categorie[]    findAll()
 * @method Categorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categorie::class);
    }


    public function countAllCategories()
    {
        $queryBuilder = $this->createQueryBuilder('c');
        $queryBuilder->select('COUNT(c.id)as value');

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }

    /**
     * @return Categorie[]
     */
    public function findAllById(): array
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.id', 'DESC')
//            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Categorie[]
     */
    public function findLastThreeCategorie(): array
    {
        return $this->createQueryBuilder('c')

            ->orderBy('c.id', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }

    public function findActuByCategorie(Categorie $categorie)
    {
        $qb = $this->createQueryBuilder('a')
            ->innerJoin('a.actualites', 'c')
            ->andWhere('a.actualites = :name')
            ->setParameter('categorie', $categorie);
        return $qb
//            ->orderBy('a.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

//    public function findByExampleField($value)
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }


    /*
    public function findOneBySomeField($value): ?Categorie
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
