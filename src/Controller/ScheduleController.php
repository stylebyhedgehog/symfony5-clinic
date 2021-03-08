<?php

namespace App\Controller;

use App\configurations\SpecialityConfig;
use App\Entity\Schedule;
use App\Form\ScheduleType;
use App\Repository\DoctorRepository;
use App\Repository\ScheduleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ScheduleController extends AbstractController
{
    /**
     * @Route("/schedule", name="listSpeciality")
     * @return RedirectResponse|Response
     */
    public function indexUser(){
        $listSpeciality= SpecialityConfig::getList();
        return $this->render('global/listSpeciality.html.twig',
        ['listSpeciality' => $listSpeciality]);
    }

    /**
     * Add new Schedule Item CREATE
     * @Route("/admin/schedule/add", name="addSchedule")
     * @param Request $request
     * @param ScheduleRepository $scheduleRepository
     * @return RedirectResponse|Response
     */
    public function addSchedule(Request $request,ScheduleRepository $scheduleRepository){
        $schedule = new Schedule();
        $form = $this->createForm(ScheduleType::class, $schedule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $id=$form["doctor"]->getData();
            $schedule->setIdDoctor($id);
            $scheduleRepository->save($schedule);
            return $this->redirectToRoute('listSpeciality');
        }
        return $this->render('admin/addSchedule.html.twig', [
            'form' => $form->createView(),
        ]);
    }




    /**
     * Show all|by speciality Schedule Items READ
     * @Route ("/schedule/{speciality}",name="listSchedule")
     * @param Request $request
     * @param ScheduleRepository $scheduleRepository
     * @param DoctorRepository $doctorRepository
     * @return Response
     */
    public function listScheduleBySpeciality(Request $request,ScheduleRepository $scheduleRepository, DoctorRepository $doctorRepository){
        $listSchedule=$scheduleRepository->findByDoctorSpeciality($request->get("speciality"),$doctorRepository);
        return $this->render('global/listSchedule.html.twig',[
            "listSchedule"=>$listSchedule,
        ]);
    }

    /**
     * Update Doctor with <id> UPDATE
     * @Route ("/admin/schedule/edit/{id<\d+>}",name="updateSchedule")
     * @param Request $request
     * @param ScheduleRepository $scheduleRepository
     * @return RedirectResponse|Response
     */
    public function updateSchedule(Request $request,ScheduleRepository $scheduleRepository){
        $schedule = $scheduleRepository->find($request->get("id"));
        $form = $this->createForm(ScheduleType::class, $schedule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $scheduleRepository->save($schedule);
            return $this->redirectToRoute('listSpeciality');
        }
        return $this->render('admin/addSchedule.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Delete Schedule with <id> DELETE
     * @Route ("/admin/schedule/delete/{id<\d+>}",name="deleteSchedule")
     * @param Request $request
     * @param ScheduleRepository $scheduleRepository
     * @return RedirectResponse
     */
    public function deleteSchedule(Request $request,ScheduleRepository $scheduleRepository){
        $scheduleId=$request->get("id");
        $schedule=$scheduleRepository->find($scheduleId);
        $scheduleRepository->delete($schedule);
        return $this->redirectToRoute('listSpeciality');
    }


}
