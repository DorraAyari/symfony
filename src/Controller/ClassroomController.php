<?php

namespace App\Controller;

use App\Entity\Classroom;
use App\Form\ClassroomType;

use App\Repository\ClassroomRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassroomController extends AbstractController
{
    #[Route('/classroom', name: 'app_classroom')]
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',

        ]);
    }
    #[Route('/afficheall', name: 'app_afficheall')]
    public function afficheall(ClassroomRepository $classroomrepository): Response
    {
        $classrooms=$classroomrepository->findAll();
        return $this->render('dorra/afficher.html.twig', [
            'classrooms' => $classrooms,
        ]);
    }
    #[Route('/ajouter', name: 'ajouter')]

    public function ajouter(Request $request , ManagerRegistry $doctrine): Response
    {
       $classroom = new Classroom;
       $form = $this->createForm(ClassroomType::class,$classroom);
       $form->handleRequest($request);
       if ($form ->IsSubmitted()){
        $em=$doctrine->getManager();
       //persist=ajouter
       $em->persist($classroom);
       //flush=push
       $em->flush();
       return $this->redirectToRoute('app_afficheall', [
    ]);
       }

       return $this->render('dorra/ajoutercl.html.twig', [
        'classroom' => $form->createView(),
    ]);
       
    }
    

    #[Route('modifier/{id}', name: 'modifier')]

    public function modifier(Request $request , ManagerRegistry $doctrine,Classroom $classroom): Response
    {
        
       $form = $this->createForm(ClassroomType::class,$classroom);
       $form->handleRequest($request);
       if ($form ->IsSubmitted()){
        $em=$doctrine->getManager();
       //persist=ajouter
       $em->persist($classroom);
       //flush=pish
       $em->flush();
       return $this->redirectToRoute('app_afficheall', [
    ]);
       }

       return $this->render('dorra/modifiercl.html.twig', [
        'classroom' => $form->createView(),
    ]);
       
    }
    #[Route('supprimer/{id}', name: 'supprimer')]

    public function supprimer($id , ManagerRegistry $doctrine): Response
{
    $em=$doctrine->getManager();
    $classroom =$doctrine->getRepository(Classroom::class);
    $classroom =  $classroom->find($id);
    $em->remove($classroom);
$em->flush();
return $this->redirectToRoute('app_afficheall');

}
}