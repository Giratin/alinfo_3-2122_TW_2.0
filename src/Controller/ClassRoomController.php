<?php

namespace App\Controller;

use App\Entity\ClassRoom;
use App\Form\ClassroomType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassRoomController extends AbstractController
{
    /**
     * @Route("/classroom", name="class_room")
     */
    public function index(): Response
    {
        $respository = $this->getDoctrine()->getRepository(ClassRoom::class);
        $classeListe = $respository->findAll();
        //$liste = $respository->findBy([ 'id' => 1, 'Name' => 'test' ]);
        //$liste = $respository->findByName('test');

        return $this->render('class_room/index.html.twig', [
            'liste' => $classeListe
        ]);
    }

    /**
     * @Route("/createClassRoom", name="createClassRoom")
     */
    public function createClassRoom(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $classroom = new ClassRoom();
        $classroom->setName("1ALINFO3");
        $form = $this->createForm(ClassroomType::class, $classroom);

        //handle request
        $form->handleRequest($request);

        //check  form submission
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($classroom);
            $em->flush();
            return $this->redirect("/classroom");
        }

        return $this->render('class_room/create.html.twig', [
            'class_form' => $form->createView()
        ]);
    }

    /**
     * @Route("/updateClassRoom/{id}", name="updateClassRoom")
     */
    public function updateClassRoom(Request $request, $id) : Response{

        $em = $this->getDoctrine()->getManager();
        $classroom = $em->getRepository(ClassRoom::class)->find($id);

        $form = $this->createForm(ClassroomType::class, $classroom);

        //handle request
        $form->handleRequest($request);

        //check  form submission
        if($form->isSubmitted() && $form->isValid()){
            $em->flush();
            return $this->redirect("/classroom");
        }

        return $this->render('class_room/create.html.twig', [
            'class_form' => $form->createView()
        ]);
    }
    /**
     * @Route("/deleteClassRoom/{id}", name="deleteClassRoom")
     */
    public function deleteClassRoom(Request $request, $id) : Response
    {
        $em = $this->getDoctrine()->getManager();
        $classroom = $em->getRepository(ClassRoom::class)->find($id);
        $em->remove($classroom);
        $em->flush();
        return $this->redirect("/classroom");
    }
}
