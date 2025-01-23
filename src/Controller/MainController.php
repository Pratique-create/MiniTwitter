<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MainController extends AbstractController
{
    #[Route('/', name: 'home_page')]
    public function index(): Response
    {
        
        return $this->render('base.html.twig', [
            "controller_name" => "MainController",
        ]);
    }
}
