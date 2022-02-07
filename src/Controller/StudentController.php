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
    public function index(Request $request): Response
    {
        $em =  $this->getDoctrine()->getManager();
        $students = $em->getRepository(Student::class)->getStudentsOrderedByEmail();

        $search = $request->query->get('search');
        if($search){
            $students = $em->getRepository(Student::class)->searchStudents($search);
        }

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

    /**
     * @Route("/betweenDate", name="betweenDate")
     */
    public function betweenDate(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $students = $em->createQuery('SELECT s FROM App\Entity\Student s WHERE s.birthDate between :val1 and :val2')
                        ->setParameter('val1', '2000-11-02')
                        ->setParameter('val2', '2002-11-02')
                        ->getResult();

        return $this->render('student/index.html.twig', [
            'students' => $students,
        ]);
    }


    /**
     * @Route("/moyenne", name="moyenne")
     */
    public function Moyenne(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $value = $em->createQuery('
                SELECT AVG(s.moyenne) as average FROM App\Entity\Student s 
                JOIN s.classroom c WHERE c.Name = :name')
                        ->setParameter('name', '1 alinfo 1')
                        ->getResult();

        return $this->render('student/moyenne.html.twig', [
            'classroom' => '1 alinfo 1',
            'value' => $value
        ]);

    }

    /**
     * @Route("/rechercheMoyenne", name="moyenne")
     */
    public function rechercheMoyenne(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();

        $students = $em->getRepository(Student::class)->findAll();

        $minMoy = $request->query->get('minMoy');
        $maxMoy = $request->query->get('maxMoy');

        if($minMoy && $maxMoy){
            $students = $em->createQuery('
                SELECT s FROM App\Entity\Student s WHERE s.moyenne between :minVal and :maxVal
            ')->setParameter('minVal',$minMoy)->setParameter('maxVal',$maxMoy)->getResult();
        }

        return $this->render('student/moyenne.html.twig', [
            'students' => $students,
        ]);
    }


    /**
     * @Route("/Redoublant", name="Redoublant")
     */
    public function Redoublant(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $redoublants = $em->createQuery(
            'SELECT COUNT(s.nsc) as nbre, (c.Name) as classname FROM App\Entity\Student s 
            JOIN s.classroom c WHERE s.moyenne < 8 GROUP BY s.classroom'
        )->getResult();



        return $this->render('student/redoublant.html.twig', [
            'redoublants' => $redoublants,
        ]);
    }



}
