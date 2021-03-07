<?php

namespace App\Controller;

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
     * @Route("/", name="listSpeciality")
     * @return RedirectResponse|Response
     */
    public function indexUser(){
        return $this->render('user/listSpeciality.html.twig');
    }



    /**
     * Add new Schedule Item CREATE
     * @Route("/admin/addSchedule", name="addSchedule")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function addSchedule(Request $request){
        $schedule = new Schedule();

        $form = $this->createForm(ScheduleType::class, $schedule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $id=$form["doctor"]->getData();
            $schedule->setIdDoctor($id);
            $em = $this->getDoctrine()->getManager();

            $em->persist($schedule);
            $em->flush();

            return $this->redirectToRoute('allSchedule');
        }
        return $this->render('admin/addSchedule.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * Show all Schedule ROLE_ADMIN Items READ
     * @Route ("/admin/schedule",name="allSchedule")
     * @param ScheduleRepository $scheduleRepository
     * @return Response
     */
    public function listSchedule(ScheduleRepository $scheduleRepository){
        $listSchedule=$scheduleRepository->findAll();
        return $this->render('admin/listSchedule.html.twig',[
            "listSchedule"=>$listSchedule,
        ]);
    }

    /**
     * Show all Schedule ROLE_USER Items READ
     * @Route ("/schedule/{speciality}",name="allScheduleUser")
     * @param Request $request
     * @param ScheduleRepository $scheduleRepository
     * @param DoctorRepository $doctorRepository
     * @return Response
     */
    public function listScheduleBySpeciality(Request $request,ScheduleRepository $scheduleRepository, DoctorRepository $doctorRepository){
        $listSchedule=$scheduleRepository->findByDoctorSpeciality($request->get("speciality"),$doctorRepository);
        return $this->render('user/listSchedule.html.twig',[
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
            $em = $this->getDoctrine()->getManager();
            $em->persist($schedule);
            $em->flush();

            return $this->redirectToRoute('allSchedule');
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
        $schedule=$scheduleRepository->find($request->get("id"));
        $scheduleRepository->delete($schedule);
        return $this->redirectToRoute('allSchedule');
    }


}
