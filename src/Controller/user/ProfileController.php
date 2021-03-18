<?php


namespace App\Controller\user;


use App\Repository\MedicalCartRepository;
use App\Repository\UserAppointmentsRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route ("/user/{id_user}")
 */
class ProfileController extends AbstractController
{
    private $userRepository;
    private $medicalCartRepository;
    private $userAppointmentsRepository;

    /**
     * ProfileController constructor.
     * @param UserAppointmentsRepository $userAppointmentsRepository
     * @param UserRepository $userRepository
     * @param MedicalCartRepository $medicalCartRepository
     */
    public function __construct(UserAppointmentsRepository $userAppointmentsRepository,UserRepository $userRepository, MedicalCartRepository $medicalCartRepository)
    {
        $this->userAppointmentsRepository=$userAppointmentsRepository;
        $this->userRepository = $userRepository;
        $this->medicalCartRepository=$medicalCartRepository;
    }

    /**
     * @Route ("/profile", name="user_profile")
     * @param Request $request
     * @return Response
     */
    public function profileData(Request $request){
        //линые данные
        $userId = $request->get("id_user");
        $user = $this->userRepository->find($userId);
        //мед карта
        $medicalCart=$this->medicalCartRepository->findBy(array('idUser' => $userId));
        if ($medicalCart == null){
            $medicalCart[0]=null;
        }
        //записи
        $appointments=$this->userAppointmentsRepository->findBy(array('idUser' => $userId));
        return $this->render('user/profile.html.twig', [
            'user' => $user,
            'medicalCart' =>$medicalCart[0],
            'appointments'=>$appointments
        ]);
    }
}