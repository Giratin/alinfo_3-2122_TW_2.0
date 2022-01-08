<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{

    /**
     * @Route("/articles", name="liste")
     * @return Response
     */
    public function index(): Response
    {
        $name = "World";
        return $this->render("articles/index.html.twig", [
            "current_link" => "articles",
            "var_name" => $name
        ]);


    }


    /**
     * @Route("/test/{name}", name="test")
     * @return Response
     */
    public function getParams($name): Response
    {
        return $this->render("articles/details.html.twig", [
            "name" => $name
        ]);
    }
}
