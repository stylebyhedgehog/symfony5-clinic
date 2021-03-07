<?php

namespace App\Repository;

use App\Entity\Schedule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Schedule|null find($id, $lockMode = null, $lockVersion = null)
 * @method Schedule|null findOneBy(array $criteria, array $orderBy = null)
 * @method Schedule[]    findAll()
 * @method Schedule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScheduleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Schedule::class);
    }

    public function decSlots(int $idSchedule){
        $entityManager = $this->getEntityManager();
        $schedule=$this->find($idSchedule);
        $schedule->setSlots($schedule->getSlots()-1);
        $entityManager->flush();
    }

    public function findByDoctorSpeciality(string $filterParam, DoctorRepository $doctorRepository){
        $filteredSchedule=[];
        $schedule=$this->findAll();
        if ($filterParam =="all"){
            return $schedule;
        }
        foreach ($schedule as $item){
            $doctor=$item->getIdDoctor();
            if ($doctor->getSpeciality()==$filterParam){
                array_push($filteredSchedule,$item);
            }
        }
        return $filteredSchedule;
    }
    public function delete(Schedule $schedule)
    {
        $this->getEntityManager()->remove($schedule);
        $this->getEntityManager()->flush();
    }
}
