<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConfirmReservationController extends AbstractController
{
    /**
     * @Route("/confirm/reservation", name="app_confirm_reservation")
     */
    public function index(): Response
    {
        return $this->render('confirm_reservation/index.html.twig', [
            'controller_name' => 'ConfirmReservationController',
        ]);
    }
}
