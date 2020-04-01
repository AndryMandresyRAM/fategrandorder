<?php

namespace App\Repository;

use App\Entity\Master;
use App\Entity\MasterSearch;
use App\Entity\Servant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @method Master|null find($id, $lockMode = null, $lockVersion = null)
 * @method Master|null findOneBy(array $criteria, array $orderBy = null)
 * @method Master[]    findAll()
 * @method Master[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MasterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Master::class);
    }

    // /**
    //  * @return Master[] Returns an array of Master objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Master
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    private function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('m');
    }

    

    public function findAllVisible(MasterSearch $search) : array
    {
        $query = $this->findVisibleQuery();

        if($search->getName()){
            $query = $query
            ->andWhere("m.name = :name")
            ->setParameter('name', $search->getName());
        }

        if ($search->getMagictype()) {
            $query = $query
                ->andWhere("m.magictype = :mt")
                ->setParameter('mt', $search->getMagictype());
        }

        return $query->getQuery()->getResult();
    }
}
