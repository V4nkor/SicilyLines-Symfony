<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceContactController extends AbstractController
{
    /**
     * @Route("/service/contact", name="app_service_contact")
     */
    public function index(): Response
    {
        return $this->render('service_contact/index.html.twig', [
            'controller_name' => 'ServiceContactController',
        ]);
    }
}
