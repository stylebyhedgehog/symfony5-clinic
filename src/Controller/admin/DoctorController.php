<?php

namespace App\Controller\admin;

use App\Entity\Doctor;
use App\Form\DoctorType;
use App\Repository\DoctorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * @Route("/admin/doctor")
 * @package App\Controller
 */
class DoctorController extends AbstractController
{
    private $doctorRepository;

    /**
     * DoctorController constructor.
     * @param DoctorRepository $doctorRepository
     */
    public function __construct(DoctorRepository $doctorRepository)
    {
        $this->doctorRepository=$doctorRepository;
    }

    /**
     * @Route("/create", name="admin_doctor_create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $doctor = new Doctor();
        $form = $this->createForm(DoctorType::class, $doctor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->doctorRepository->save($doctor);
            return $this->redirectToRoute('admin_doctor_all');
        }
        return $this->render('admin/doctorCE.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route ("/", name="admin_doctor_all")
     * @return Response
     */
    public function all(){
        $listDoctors=$this->doctorRepository->findAll();
        return $this->render('admin/doctorAll.html.twig',[
            "doctors"=>$listDoctors,
        ]);
    }

    /**
     * @Route ("/{id<\d+>}/edit",name="admin_doctor_edit")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function edit(Request $request){
        $idDoctor=$request->get("id");
        $doctor = $this->doctorRepository->find($idDoctor);
        $form = $this->createForm(DoctorType::class, $doctor);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->doctorRepository->save($doctor);
            return $this->redirectToRoute('admin_doctor_all');
        }
        return $this->render('admin/doctorCE.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route ("/{id<\d+>}/delete",name="admin_doctor_remove")
     * @param Request $request
     * @return RedirectResponse
     */
    public function remove(Request $request){
        $doctor=$this->doctorRepository->find($request->get("id"));
        $this->doctorRepository->delete($doctor);
        return $this->redirectToRoute('admin_doctor_all');
    }


}