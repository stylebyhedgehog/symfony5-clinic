<?php

namespace App\Repository;

use App\Entity\MedicalCart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MedicalCart|null find($id, $lockMode = null, $lockVersion = null)
 * @method MedicalCart|null findOneBy(array $criteria, array $orderBy = null)
 * @method MedicalCart[]    findAll()
 * @method MedicalCart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MedicalCartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MedicalCart::class);
    }

    // /**
    //  * @return MedicalCart[] Returns an array of MedicalCart objects
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
    public function findOneBySomeField($value): ?MedicalCart
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
