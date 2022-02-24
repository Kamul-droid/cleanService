<?php

namespace App\Repository;

use App\Entity\SubEmail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SubEmail|null find($id, $lockMode = null, $lockVersion = null)
 * @method SubEmail|null findOneBy(array $criteria, array $orderBy = null)
 * @method SubEmail[]    findAll()
 * @method SubEmail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubEmailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SubEmail::class);
    }

    // /**
    //  * @return SubEmail[] Returns an array of SubEmail objects
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
    public function findOneBySomeField($value): ?SubEmail
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
