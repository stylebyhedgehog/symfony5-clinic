<?php


namespace App\Controller\admin;


use App\configurations\MedicalCartConfig;
use App\Repository\MedicalCartRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route ("/admin/medical_cart")
 */
class MedicalCartController extends AbstractController
{
    private $medicalCartRepository;

    /**
     * MedicalCartController constructor.
     * @param MedicalCartRepository $medicalCartRepository
     */
    public function __construct(MedicalCartRepository $medicalCartRepository)
    {
        $this->medicalCartRepository=$medicalCartRepository;
    }

    /**
     * @Route ("/", name="admin_medical_cart_all")
     */
    public function all(){
        $medical_carts=$this->medicalCartRepository->findAll();
        return $this->render('admin/medicalCardAll.html.twig', [
            'medical_carts' => $medical_carts,
        ]);
    }
    /**
     * @Route ("/{id_cart}/edit/", name="admin_medical_cart_edit")
     * @param Request $request
     * @return Response
     */
    public function edit(Request $request){
        $medical_cart=$this->medicalCartRepository->find($request->get('id_cart'));
        if($request->get("type") == "0"){
            $medical_cart->setStatus(MedicalCartConfig::$status_ok);
        }
        $this->medicalCartRepository->save($medical_cart);
        return $this->redirectToRoute('admin_medical_cart_all');
    }
}