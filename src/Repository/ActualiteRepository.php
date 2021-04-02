<?php

namespace App\Repository;

use App\Entity\Actualite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Actualite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Actualite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Actualite[]    findAll()
 * @method Actualite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActualiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Actualite::class);
    }

    /**
     * @return Actualite[]
     */
    public function findAllById(): array
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.id', 'DESC')
//            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }


    /**
     * @return Actualite[]
     */
    public function findLatest(): array
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.id', 'DESC')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Actualite[]
     */
    public function findLastTwo(): array
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.id', 'DESC')
            ->setMaxResults(2)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Actualite[]
     */
    public function findLastThree(): array
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.id', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }


    /**
     * @return Actualite[]
     */
    public function findLastSix(): array
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.id', 'DESC')
            ->setMaxResults(6)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param Actualite $actualite
     * @return int|mixed|string
     */
    public function findCategoryByActualite(Actualite $actualite)
    {
        $qb = $this->createQueryBuilder('a')
            ->innerJoin('c.actualite', 'c' )
            ->andWhere('c.actualite = :name')
            ->setParameter('actualite', $actualite);

        return $qb
//            ->orderBy('a.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return int|mixed|string|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function countAllActualites()
    {
        $queryBuilder = $this->createQueryBuilder('a');
        $queryBuilder->select('COUNT(a.id)as value');

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }

    /**
     * recherchez les actus en fonction du formulaire
     * @param null $mots
     * @param null $categorie
     * @return int|mixed|string
     */
    public function search($mots = null, $categorie =null){
        $query = $this->createQueryBuilder('a');
        if($mots != null){
            $query->andWhere('MATCH_AGAINST(a.titre, a.description) AGAINST(:mots boolean)>0')
                ->setParameter('mots', $mots);
        }
        if($categorie != null){
            //on prend les actus qui ont la même catégorie
            $query->leftJoin('a.categorie', 'c');
            //on verifie que l id de la categorie est bien l id envoyé
//            par l'intermediaire de la fonction (en paramètre)
            $query->andWhere('c.id = :id')
                ->setParameter('id', $categorie);
        }
        return $query->getQuery()->getResult();
    }

    /**
     * @return Actualite[]
     */
    public function findLastThreeByCategorie(): array
    {
        return $this->createQueryBuilder('a')
            ->innerJoin('a.categorie', 'c')
//            ->orderBy('a.categorie', 'ASC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();

    }


    /*
    public function findOneBySomeField($value): ?Actualite
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
