<?php

namespace App\Controller;

use App\Entity\Users;
use App\Entity\UsersRecordings;
use App\Repository\ScheduleRepository;
use App\Repository\UserRepository;
use App\Repository\UsersRepository;
use App\Resource\ScheduleResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ScheduleController extends AbstractController
{

    /**
     * @Route("/schedule/{specialty}", name="schedule")
     * @param string $specialty
     * @param ScheduleRepository $scheduleRepository
     * @param UserRepository $usersRepository
     * @return Response
     */
    public function getAll(string $specialty,ScheduleRepository $scheduleRepository, UserRepository $usersRepository): Response
    {
        $schedule = $scheduleRepository->findAll();
        $realSchedule =array();
        foreach ($schedule as $value) {
            $doctor=$usersRepository->find($value->getIdDoctor());
//            if ($doctor->getRoles()[0] == $specialty){
                $scheduleResource= new ScheduleResource();
                $scheduleResource->toResource($value, $doctor);
                array_push($realSchedule,$scheduleResource);
//            }
        }
        return $this->render('schedule/index.html.twig', [
            'schedule' => $realSchedule,
        ]);
    }

    /**
     * @Route("/schedule/item/{id<\d+>}", name="scheduleItem")
     * @param int $id
     * @param ScheduleRepository $scheduleRepository
     * @param UserRepository $usersRepository
     * @return Response
     */
    public function getScheduleItem(int $id, ScheduleRepository $scheduleRepository,UserRepository $usersRepository){
        $scheduleItem=$scheduleRepository->find($id);
        $doctor=$usersRepository->find($scheduleItem->getIdDoctor());
        $scheduleResourceItem=new ScheduleResource();
        $scheduleResourceItem->toResource($scheduleItem, $doctor);
        return $this->render(
            'schedule/item.html.twig',
            [
                'item' => $scheduleResourceItem,
            ]
        );
    }

    /**
     * @Route("/schedule/item/recording/{id<\d+>}", name="createRecording")
     * @param int $id
     * @param ScheduleRepository $scheduleRepository
     */
    public function createRecording(int $id, ScheduleRepository $scheduleRepository){

        $userId = $this->get('security.token_storage')->getToken()->getUser();
        $recordingId=$scheduleRepository->find($id);
        $entityManager = $this->getDoctrine()->getManager();

        $rec = new UsersRecordings();
        $rec->setIdSchedule($recordingId);
        $rec->setIdUser($userId);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($rec);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        $scheduleRepository->decSlots($id);
        return $this->redirectToRoute('specialities');
    }
}
