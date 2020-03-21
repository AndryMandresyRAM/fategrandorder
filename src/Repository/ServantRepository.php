<?php

namespace App\Repository;

use App\Entity\Servant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @method Servant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Servant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Servant[]    findAll()
 * @method Servant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Servant::class);
    }

    // /**
    //  * @return Servant[] Returns an array of Servant objects
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
    *
    *@return servant;
    *
     */

    public function findClass() :  array{
        return $this->createQueryBuilder('s')
            ->where('s.Class = :actual')->setParameter('actual',"Saber")
            ->getQuery()
            ->getResult();
    }


    public function findLatest(): array
    {
        return $this->createQueryBuilder('s')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }

    /* AFAKA AMPIASAINA ATO ANATY CLASSE RAHA MISY REPETITION BE LOATRA */
    private function findVisibleQuery() : QueryBuilder
    {
        return $this->createQueryBuilder('s')
        ->where('s.Class = :actual')->setParameter('actual', "Saber");
    }
    /*
    public function findOneBySomeField($value): ?Servant
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
