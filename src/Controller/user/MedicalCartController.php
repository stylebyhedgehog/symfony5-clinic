<?php


namespace App\Controller\user;


use App\configurations\MedicalCartConfig;
use App\Entity\MedicalCart;
use App\Form\MedicalCartType;
use App\Repository\MedicalCartRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route ("/user/{id_user}/medical_cart")
 */
class MedicalCartController extends AbstractController
{
    private $medicalCartRepository;
    private $userRepository;

    /**
     * MedicalCartController constructor.
     * @param UserRepository $userRepository
     * @param MedicalCartRepository $medicalCartRepository
     */
    public function __construct(UserRepository $userRepository,MedicalCartRepository $medicalCartRepository)
    {
        $this->userRepository=$userRepository;
        $this->medicalCartRepository=$medicalCartRepository;
    }


    /**
     * @Route ("/create", name="user_medical_cart_create")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function create(Request $request){
        $medical_cart = new MedicalCart();
        $form = $this->createForm(MedicalCartType::class, $medical_cart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user=$this->userRepository->find($request->get("id_user"));
            $medical_cart->setStatus(MedicalCartConfig::$status_await);
            $medical_cart->setIdUser($user);
            $this->medicalCartRepository->save($medical_cart);
            return $this->redirectToRoute('user_profile',array("id_user"=>$request->get("id_user")));
        }
        return $this->render('user/medicalCartCE.html.twig', [
            'form' => $form->createView(),

        ]);
    }
}