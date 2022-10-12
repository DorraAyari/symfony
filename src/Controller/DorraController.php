<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DorraController extends AbstractController
{
    #[Route('/dorra', name: 'app_dorra')] //routing 
    public function index(): Response
    {  
        $bonjour="welcome dorra";
        return $this->render('dorra/index.html.twig', ["bonjour" => $bonjour] );
    }
    #[Route('/show/name/{name}', name: 'app_show')] //routing 
    public function showTeacher($name ): Response
    {

        return $this->render('dorra/showstudent.html.twig', ["name" => $name] );
    }
    #[Route('/student', name: 'app_stu')] //routing 
    public function redirectfun( ): Response
    {

        return $this->redirectToRoute('app_dorra');
    }
}
