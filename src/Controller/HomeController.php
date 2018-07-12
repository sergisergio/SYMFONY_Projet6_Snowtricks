<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    function homepage()
    {
        return $this->render('homepage.html.twig');
    }

    /**
     * @Route("/trick", name="app_trickpage")
     */
    function trickpage()
    {
        return $this->render('trick.html.twig');
    }

    /**
     * @Route("/createtrick")
     */
    function createtrickpage()
    {
        return $this->render('createtrick.html.twig');
    }

    /**
     * @Route("/modifytrick")
     */
    function modifytrickpage()
    {
        return $this->render('modifytrick.html.twig');
    }
}