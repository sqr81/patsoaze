<?php

namespace App\Repository;

use App\Entity\Exposition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Exposition|null find($id, $lockMode = null, $lockVersion = null)
 * @method Exposition|null findOneBy(array $criteria, array $orderBy = null)
 * @method Exposition[]    findAll()
 * @method Exposition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExpositionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Exposition::class);
    }

    // /**
    //  * @return Exposition[] Returns an array of Exposition objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Exposition
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
