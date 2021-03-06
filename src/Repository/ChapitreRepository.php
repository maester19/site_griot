<?php

namespace App\Repository;

use App\Entity\Chapitre;
use App\Entity\Storie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Chapitre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Chapitre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Chapitre[]    findAll()
 * @method Chapitre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChapitreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Chapitre::class);
    }

    /**
     * @return Query
     */
    public function findAllVisibleQuery(Storie $storie)
    {
       return $this->createQueryBuilder('c')
                ->where('c.storie = :val')
                ->setParameter('val', $storie)
               ->getQuery();
    }

    /**
     * @return Chapitre[]
     */
    public function findAllVisible(Storie $storie)
    {
       return $this->createQueryBuilder('c')
                ->where('c.storie = :val')
                ->setParameter('val', $storie)
               ->getQuery()
               ->getResult();
    }

    // /**
    //  * @return Chapitre[] Returns an array of Chapitre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Chapitre
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
