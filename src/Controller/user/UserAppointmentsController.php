<?php


namespace App\Controller\user;


use App\configurations\AppointmentConfig;
use App\Entity\UserAppointments;
use App\Repository\MedicalCartRepository;
use App\Repository\ScheduleRepository;
use App\Repository\UserAppointmentsRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * @Route ("/user/{id_user}/appointment/")
 */
class UserAppointmentsController extends AbstractController
{
    private $scheduleRepository;
    private $userRepository;
    private $userAppointmentsRepository;
    private $medicalCartRepository;

    /**
     * UserAppointmentsController constructor.
     * @param MedicalCartRepository $medicalCartRepository
     * @param UserAppointmentsRepository $userAppointmentsRepository
     * @param ScheduleRepository $scheduleRepository
     * @param UserRepository $userRepository
     */
    public function __construct(MedicalCartRepository $medicalCartRepository,UserAppointmentsRepository $userAppointmentsRepository,ScheduleRepository $scheduleRepository,UserRepository $userRepository)
    {
        $this->medicalCartRepository=$medicalCartRepository;
        $this->userAppointmentsRepository=$userAppointmentsRepository;
        $this->scheduleRepository = $scheduleRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @Route ("/{id_schedule}/create", name="user_appointment_create")
     * @param Request $request
     * @return RedirectResponse
     */
    public function create(Request $request){
     //TODO В РЕПОЗИТОРИЙ СОХРАНЕНИЕ СТАТУСОВ + конфиг + фикс множественных кликов + чек наличия мед карты
       $schedule=$this->scheduleRepository->find($request->get("id_schedule"));
       $user=$this->userRepository->find($request->get("id_user"));
       $appointment=new UserAppointments();

        $appointment->setIdSchedule($schedule);
        $appointment->setIdUser($user);
        $appointment->setStatus(AppointmentConfig::$status_await);
        $this->userAppointmentsRepository->save($appointment);
        $this->scheduleRepository->decSlots($request->get("id_schedule"));
        return $this->redirectToRoute('user_schedule_all');
    }

}