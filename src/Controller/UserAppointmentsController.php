<?php


namespace App\Controller;


use App\Entity\UserAppointments;
use App\Repository\ScheduleRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
class UserAppointmentsController extends AbstractController
{
    /**
     * @Route ("/appointment/{id_schedule}",name="showAppointment")
     * @param Request $request
     * @param ScheduleRepository $scheduleRepository
     * @return Response
     */
    public function showAppointment(Request $request,ScheduleRepository $scheduleRepository){
        //TODO муть
        $scheduleId = $request->get("id_schedule");
        $schedule= $scheduleRepository->find($scheduleId);

        return $this->render('user/addAppointment.html.twig', [
            'schedule' => $schedule,
        ]);
    }

    /**
     * @Route ("/appointment/add/{id_schedule}", name="addAppointment")
     * @param Request $request
     * @param ScheduleRepository $scheduleRepository
     * @param UserRepository $userRepository
     * @return RedirectResponse
     */
    public function addAppointment(Request $request, ScheduleRepository $scheduleRepository, UserRepository $userRepository){
     //TODO В РЕПОЗИТОРИЙ СОХРАНЕНИЕ СТАТУСОВ + конфиг + фикс множественных кликов
        $appoitment=new UserAppointments();
        $appoitment->setIdSchedule($scheduleRepository->find($request->get("id_schedule")));
        $appoitment->setIdUser($userRepository->find($request->get("id_user")));
        $appoitment->setStatus("WAIT");
        $em = $this->getDoctrine()->getManager();
        $em->persist($appoitment);
        $em->flush();
        $scheduleRepository->decSlots($request->get("id_schedule"));
        return $this->redirectToRoute('listSchedule', ['speciality'=> 'all']);
    }

}