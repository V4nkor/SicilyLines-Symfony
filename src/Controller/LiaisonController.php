<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LiaisonController extends AbstractController
{
    /**
     * @Route("/liaison", name="app_liaison")
     */
    public function index(): Response
    {
        return $this->render('liaison/index.html.twig', [
            'controller_name' => 'LiaisonController',
        ]);
    }
}
