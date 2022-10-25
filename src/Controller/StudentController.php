<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    #[Route('/student', name: 'app_student')]
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',

        ]);
    }
    #[Route('/readAll', name: 'readAll')]
    public function afficheall(StudentRepository $studentRepository): Response
    {
        $students=$studentRepository->findAll();
        return $this->render('student/read.html.twig', [
            'students' => $students,
        ]);
    }
    #[Route('/ajouterS', name: 'ajouterS')]

    public function ajouter(Request $request , ManagerRegistry $doctrine): Response
    {
       $student = new Student;
       $form = $this->createForm(StudentType::class,$student);
       $form->handleRequest($request);
       if ($form ->IsSubmitted()){
        $em=$doctrine->getManager();
       //persist=ajouter
       $em->persist($student);
       //flush=push
       $em->flush();
       return $this->redirectToRoute('readAll', [
    ]);
       }
       return $this->renderForm('student/ajouterS.html.twig', [
        'student' => $form,
    ]);
       
    }
    #[Route('/modifierS/{nsc}', name: 'modifierS')]

    public function modifier(Request $request , ManagerRegistry $doctrine,Student $student): Response
    {
       $form = $this->createForm(StudentType::class,$student);
       $form->handleRequest($request);
       if ($form ->IsSubmitted()){
        $em=$doctrine->getManager();
       //persist=ajouter
       $em->persist($student);
       //flush=push
       $em->flush();
       return $this->redirectToRoute('readAll', [
    ]);
       }
       return $this->renderForm('student/modifierS.html.twig', [
        'student' => $form,

    ]);
       
    }
    #[Route('supprimerS/{nsc}', name: 'supprimerS')]

    public function supprimerS($nsc , ManagerRegistry $doctrine): Response
{
    $em=$doctrine->getManager();
    $student =$doctrine->getRepository(Student::class);
    $student =  $student->find($nsc);
    $em->remove($student);
$em->flush();
return $this->redirectToRoute('readAll');

}
}
