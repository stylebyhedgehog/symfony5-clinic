<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController
{

    /**
     * @Route("/schedule", name="specialities")
     */
    public function index(): Response
    {
        return $this->render('list/index.html.twig', [
            'controller_name' => 'ScheduleController',
        ]);
    }
}
