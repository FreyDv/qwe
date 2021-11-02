<?php

namespace App\Repository;

use App\Entity\Us;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Us|null find($id, $lockMode = null, $lockVersion = null)
 * @method Us|null findOneBy(array $criteria, array $orderBy = null)
 * @method Us[]    findAll()
 * @method Us[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Us::class);
    }

    /**
     * @return Us[] Returns an array of Us objects
     */
    public function findChildren():array
    {
       return $this->createQueryBuilder('p')
           ->where('p.age < 18')
           -> getQuery()
           -> execute();
    }
    /**
     * @return Us[] Returns an array of Us objects
     */
    public function findGrown():array
    {
        return $this->createQueryBuilder('p')
            ->where('p.age > 18')
            -> getQuery()
            -> execute();
    }
    /**
     * @return Us[] Returns an array of Us objects
     */




    /*
    public function findOneBySomeField($value): ?Us
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
