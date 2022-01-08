<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/alinfo/{name}", name="alinfo")
     */
    public function index($name): Response
    {
        return $this->render('test/index.html.twig', array(
            'controller_name' => 'TestController',
            'var_num' => $name
        ));
    }
}
