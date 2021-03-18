<?php

namespace App\Controller\user;


use App\Repository\ScheduleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 *@Route("/user/schedule")
 */
class ScheduleController extends AbstractController
{
    private $scheduleRepository;

    /**
     * ScheduleController constructor.
     * @param ScheduleRepository $scheduleRepository
     */
    public function __construct(ScheduleRepository $scheduleRepository)
    {
        $this->scheduleRepository=$scheduleRepository;
    }


    /**
     * @Route ("/", name="user_schedule_all")
     * @return Response
     */
    public function all(){
        $listSchedule=$this->scheduleRepository->findAll();
        $actualSchedule=[];
        foreach ($listSchedule as $schedule){
            if ($schedule->getSlots() >0){
                array_push($actualSchedule, $schedule);
            }
        }
        return $this->render('user/scheduleAll.html.twig',[
            "schedules"=>$actualSchedule,
        ]);
    }
    /**
     * @Route ("/{id_schedule}",name="user_appointment_one")
     * @param Request $request
     * @return Response
     */
    public function one(Request $request){
        $scheduleId = $request->get("id_schedule");
        $schedule= $this->scheduleRepository->find($scheduleId);

        return $this->render('user/appointmentCE.html.twig', [
            'schedule' => $schedule,
        ]);
    }




}
