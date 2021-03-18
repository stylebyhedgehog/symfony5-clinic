<?php

namespace App\Controller\admin;

use App\Entity\Schedule;
use App\Form\ScheduleType;
use App\Repository\ScheduleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 *@Route("/admin/schedule")
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
     * @Route("/add", name="admin_schedule_create")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function create(Request $request){
        $schedule = new Schedule();
        $form = $this->createForm(ScheduleType::class, $schedule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $id=$form["doctor"]->getData();
            $schedule->setIdDoctor($id);
            $this->scheduleRepository->save($schedule);
            return $this->redirectToRoute('admin_schedule_all');
        }
        return $this->render('admin/scheduleCE.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route ("/", name="admin_schedule_all")
     * @return Response
     */
    public function all(){
        $listSchedule=$this->scheduleRepository->findAll();
        return $this->render('admin/scheduleAll.html.twig',[
            "schedules"=>$listSchedule,
        ]);
    }

    /**
     * @Route ("/{id<\d+>}/edit", name="admin_schedule_edit")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function edit(Request $request){
        $schedule = $this->scheduleRepository->find($request->get("id"));
        $form = $this->createForm(ScheduleType::class, $schedule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->scheduleRepository->save($schedule);
            return $this->redirectToRoute('admin_schedule_all');
        }
        return $this->render('admin/scheduleCE.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Delete Schedule with <id> DELETE
     * @Route ("/admin/schedule/delete/{id<\d+>}", name="admin_schedule_remove")
     * @param Request $request
     * @return RedirectResponse
     */
    public function remove(Request $request){
        $scheduleId=$request->get("id");
        $schedule=$this->scheduleRepository->find($scheduleId);
        $this->scheduleRepository->delete($schedule);
        return $this->redirectToRoute('admin_schedule_all');
    }


}
