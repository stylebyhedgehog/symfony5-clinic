<?php


namespace App\Controller\admin;


use App\configurations\AppointmentConfig;
use App\Repository\ScheduleRepository;
use App\Repository\UserAppointmentsRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route ("/admin/appointment")
 */
class UserAppointmentsController extends AbstractController
{
    private $scheduleRepository;
    private $userRepository;
    private $userAppointmentsRepository;

    /**
     * UserAppointmentsController constructor.
     * @param UserAppointmentsRepository $userAppointmentsRepository
     * @param ScheduleRepository $scheduleRepository
     * @param UserRepository $userRepository
     */
    public function __construct(UserAppointmentsRepository $userAppointmentsRepository,ScheduleRepository $scheduleRepository,UserRepository $userRepository)
    {
        $this->userAppointmentsRepository=$userAppointmentsRepository;
        $this->scheduleRepository = $scheduleRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @Route ("/", name="admin_appointment_all")
     * @return Response
     */
    public function all(){
        $appointments=$this->userAppointmentsRepository->findAll();
        $validAppointments=[];
        foreach ($appointments as $appointment){
            if (AppointmentConfig::$status_completed != $appointment->getStatus()){
                array_push($validAppointments,$appointment);
            }
        }
        return $this->render('admin/appointmentAll.html.twig', [
            'appointments' => $validAppointments,
        ]);
    }

    /**
     * @Route ("/edit/{id_appointment}", name="admin_appointment_edit")
     * @param Request $request
     * @return Response
     */
    public function edit(Request $request){
        $appointment=$this->userAppointmentsRepository->find($request->get('id_appointment'));
        if($request->get("type") == "0"){
            $appointment->setStatus(AppointmentConfig::$status_ok);
        }
        else{
            $appointment->setStatus(AppointmentConfig::$status_completed);
        }

        $this->userAppointmentsRepository->save($appointment);
        return $this->redirectToRoute('admin_appointment_all');
    }


}