<?php

namespace App\Repository;

use App\Entity\Storie;
use App\Entity\StorieSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\Migrations\Query\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Storie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Storie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Storie[]    findAll()
 * @method Storie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StorieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Storie::class);
    }

    /**
     * @return Query
     */
     public function findAllVisibleQuery(StorieSearch $search)
     {
         $query = $this->createQueryBuilder('s');

         if($search->getTitreStorie()){
             $query = $query->andWhere('s.titre = :titreStorie')
                        ->setParameter('titreStorie', $search->getTitreStorie());
         }

         if($search->getNomAuteur()){
            $query = $query->andWhere('s.auteur = :nomAuteur')
                       ->setParameter('nomAuteur', $search->getNomAuteur());
        }


        return $query->getQuery();
     }

     

    // /**
    //  * @return Storie[] Returns an array of Storie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Storie
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
