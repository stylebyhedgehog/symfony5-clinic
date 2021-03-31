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
    function debug_to_console($data) {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);

        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }

    /**
     * @Route ("/create", name="user_medical_cart_create")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function create(Request $request){
        $this->debug_to_console(dirname(__FILE__));

        $medical_cart = new MedicalCart();
        $form = $this->createForm(MedicalCartType::class, $medical_cart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user=$this->userRepository->find($request->get("id_user"));
            $medical_cart->setStatus(MedicalCartConfig::$status_await);
            $medical_cart->setIdUser($user);
            $image = $form->get('filename')->getData();
            $upload_directory="images";
            $originalFilename = $image->getClientOriginalName();
            $image->move(
                $upload_directory,
                $originalFilename
            );
            $medical_cart->setFilename($originalFilename);
            $this->medicalCartRepository->save($medical_cart);
            return $this->redirectToRoute('user_profile',array("id_user"=>$request->get("id_user")));
        }
        return $this->render('user/medicalCartCE.html.twig', [
            'form' => $form->createView(),

        ]);
    }
}