<?php

namespace App\Repository;

use App\Entity\Fermier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Fermier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fermier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fermier[]    findAll()
 * @method Fermier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FermierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fermier::class);
    }

    // /**
    //  * @return Fermier[] Returns an array of Fermier objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Fermier
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
