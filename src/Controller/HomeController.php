<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    function homePage()
    {
        return $this->render('homepage.html.twig');
    }

    /**
     * @Route("/trick", name="app_trickpage")
     */
    function trickPage()
    {
        return $this->render('trick.html.twig');
    }

    /**
     * @Route("/createtrick", name="app_createtrickpage")
     */
    function createTrickPage()
    {
        return $this->render('createtrick.html.twig');
    }

    /**
     * @Route("/modifytrick", name="app_modifytrickpage")
     */
    function modifyTrickPage()
    {
        return $this->render('modifytrick.html.twig');
    }

    /**
     * @Route("/signup", name="app_signuppage")
     */
    function signupPage()
    {
        return $this->render('signup.html.twig');
    }

    /**
     * @Route("/login", name="app_loginpage")
     */
    function loginPage()
    {
        return $this->render('login.html.twig');
    }

    /**
     * @Route("/forgotpassword", name="app_forgotpasswordpage")
     */
    function forgotPasswordPage()
    {
        return $this->render('forgotpasswordpage.html.twig');
    }
}