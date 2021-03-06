<?php

namespace App\Repository;

use App\Entity\Aquarelle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Aquarelle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Aquarelle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Aquarelle[]    findAll()
 * @method Aquarelle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AquarelleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Aquarelle::class);
    }

    /**
     * @return Aquarelle[]
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
    public function countAllAquarelles()
    {
        $queryBuilder = $this->createQueryBuilder('a');
        $queryBuilder->select('COUNT(a.id)as value');

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }

    /**
     * recherchez les actus en fonction du formulaire
     * @param null $mots
     * @return int|mixed|string
     */
    public function search($mots = null){
        $query = $this->createQueryBuilder('a');
        if($mots != null){
            $query->andWhere('MATCH_AGAINST(a.nom, a.description) AGAINST(:mots boolean)>0')
                ->setParameter('mots', $mots);
        }

        return $query->getQuery()->getResult();
    }

    // /**
    //  * @return Aquarelle[] Returns an array of Aquarelle objects
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
    public function findOneBySomeField($value): ?Aquarelle
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
