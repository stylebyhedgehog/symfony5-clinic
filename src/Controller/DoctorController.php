<?php

namespace App\Controller;

use App\Entity\Doctor;
use App\Form\DoctorType;
use App\Repository\DoctorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DoctorController extends AbstractController
{
    /**
     * Add new Doctor CREATE
     * @Route("/admin/doctor/add", name="addDoctor")
     * @param Request $request
     * @param DoctorRepository $doctorRepository
     * @return Response
     */
    public function addDoctor(Request $request,DoctorRepository $doctorRepository): Response
    {
        $doctor = new Doctor();
        $form = $this->createForm(DoctorType::class, $doctor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $doctorRepository->save($doctor);
            return $this->redirectToRoute('allDoctors');
        }
        return $this->render('admin/addDoctor.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Show all Doctors READ
     * @Route ("/admin/doctor",name="allDoctors")
     * @param DoctorRepository $doctorRepository
     * @return Response
     */
    public function listDoctors(DoctorRepository $doctorRepository){
        $listDoctors=$doctorRepository->findAll();
        return $this->render('admin/listDoctor.html.twig',[
            "doctors"=>$listDoctors,
        ]);
    }

    /**
     * Update Doctor with <id> UPDATE
     * @Route ("/admin/doctor/edit/{id<\d+>}",name="updateDoctor")
     * @param Request $request
     * @param DoctorRepository $doctorRepository
     * @return RedirectResponse|Response
     */
    public function updateDoctor(Request $request,DoctorRepository $doctorRepository){
        $idDoctor=$request->get("id");
        $doctor = $doctorRepository->find($idDoctor);
        $form = $this->createForm(DoctorType::class, $doctor);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $doctorRepository->save($doctor);
            return $this->redirectToRoute('allDoctors');
        }
        return $this->render('admin/addDoctor.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Delete Doctor with <id> DELETE
     * @Route ("/admin/doctor/delete/{id<\d+>}",name="deleteDoctor")
     * @param Request $request
     * @param DoctorRepository $doctorRepository
     * @return RedirectResponse
     */
    public function deleteDoctor(Request $request,DoctorRepository $doctorRepository){
        $doctor=$doctorRepository->find($request->get("id"));
        $doctorRepository->delete($doctor);
        return $this->redirectToRoute('allDoctors');
    }


}