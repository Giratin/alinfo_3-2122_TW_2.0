<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student")
     */
    public function index(): Response
    {
        $students = $this->getDoctrine()->getRepository(Student::class)->findAll();

        return $this->render('student/index.html.twig', [
            'students' => $students,
        ]);
    }

    /**
     * @Route("/createStudent", name="createStudent")
     */
    public function createStudent(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $student = new Student();

        $form = $this->createForm(StudentType::class,  $student);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($student);
            $em->flush();
            return $this->redirect("/student");
        }

        return $this->render('student/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/updateStudent/{id}", name="updateStudent")
     */
    public function updateStudent(Request $request, $id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $student = $em->getRepository(Student::class)->findOneBy([ 'nsc' => $id ]);

        $form = $this->createForm(StudentType::class,  $student);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->flush();
            return $this->redirect("/student");
        }

        return $this->render('student/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/removeStudent/{id}", name="removeStudent")
     */
    public function removeStudent($id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $student = $em->getRepository(Student::class)->findOneBy([ 'nsc' => $id]);
        $em->remove($student);
        $em->flush();
        return $this->redirect("/student");
    }



}
