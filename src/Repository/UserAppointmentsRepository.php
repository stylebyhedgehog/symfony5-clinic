<?php

namespace App\Repository;

use App\Entity\UserAppointments;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserAppointments|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserAppointments|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserAppointments[]    findAll()
 * @method UserAppointments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserAppointmentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserAppointments::class);
    }
    public function save(UserAppointments $userAppointments){
        $em=$this->getEntityManager();
        $em->persist($userAppointments);
        $em->flush();
    }

    // /**
    //  * @return UserAppointments[] Returns an array of UserAppointments objects
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
    public function findOneBySomeField($value): ?UserAppointments
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
