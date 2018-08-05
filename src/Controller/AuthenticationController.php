<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AuthenticationController
 * @package App\Controller
 */
class AuthenticationController extends AbstractController
{
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

    /**
     * @Route("/resetpassword", name="app_resetpasswordpage")
     */
    function resetPasswordPage()
    {
        return $this->render('resetpasswordpage.html.twig');
    }
}
