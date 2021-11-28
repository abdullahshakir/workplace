<?php

namespace App\Repository;

use App\Entity\UserFollowing;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserFollowing|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserFollowing|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserFollowing[]    findAll()
 * @method UserFollowing[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserFollowingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserFollowing::class);
    }

    // /**
    //  * @return UserFollowing[] Returns an array of UserFollowing objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserFollowing
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
