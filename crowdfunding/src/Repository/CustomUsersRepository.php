<?php

namespace App\Repository;

use App\Entity\CustomUsers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CustomUsers|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomUsers|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomUsers[]    findAll()
 * @method CustomUsers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomUsersRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CustomUsers::class);
    }

//    /**
//     * @return CustomUsers[] Returns an array of CustomUsers objects
//     */
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
    public function findOneBySomeField($value): ?CustomUsers
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
