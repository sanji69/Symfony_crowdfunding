<?php

namespace App\Repository;

use App\Entity\Articles;
//use App\Entity\Users;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Articles|null find($id, $lockMode = null, $lockVersion = null)
 * @method Articles|null findOneBy(array $criteria, array $orderBy = null)
 * @method Articles[]    findAll()
 * @method Articles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticlesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Articles::class);
    }


    public function articleUser()
    {
        return $this->createQueryBuilder('a')
            ->leftJoin('a.user_id', 'u')
            ->getQuery()
            ->getResult()
            ;

    }

    public function articlesNews() : array
    {
        return $this->createQueryBuilder('a')
            ->where('a.actived = :val')
            ->setParameter('val', 1)
            ->orderBy('a.id', 'DESC')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult()
        ;
    }

//    /**
//     * @return Articles[] Returns an array of Articles objects
//     */
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

//$request = "SELECT * FROM articles LEFT OUTER JOIN users ON aticles.user_id = users.id";
//$stmt = $this->getDoctrine()->getConnection()->prepare($request);
//$stmt->execute();
//$articles = $stmt->fetchAll();


    /*
    public function findOneBySomeField($value): ?Articles
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
