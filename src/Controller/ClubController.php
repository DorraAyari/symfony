<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClubController extends AbstractController
{
    #[Route('/club', name: 'app_club')]
    public function index(): Response
    {
        return $this->render('dorra/club.html.twig', [
            'controller_name' => 'ClubController',
        ]);
    }

    #[Route('/cc/getName/{nom}', name: 'app_cc')]
    public function getName($nom)
    {
        return $this->render('dorra/club.html.twig', [
            'club' => $nom,
        ]);
    }
}
