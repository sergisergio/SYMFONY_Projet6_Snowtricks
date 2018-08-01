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
        $tricks = [
            'figure 1',
            'figure 2',
            'figure 3',
            'figure 4',
            'figure 5',
            'figure 6',
            'figure 7',
            'figure 8',
            'figure 9',
            'figure 10',

        ];

        $images = [
            'https://assets.vogue.com/photos/5892046d186d7c1b6493d0cb/master/pass/embed-silje-norendal-snowboard-cold-weather-beauty-products.jpg',
            'https://assets.vogue.com/photos/5892046d186d7c1b6493d0cb/master/pass/embed-silje-norendal-snowboard-cold-weather-beauty-products.jpg',
            'https://assets.vogue.com/photos/5892046d186d7c1b6493d0cb/master/pass/embed-silje-norendal-snowboard-cold-weather-beauty-products.jpg',
            'https://assets.vogue.com/photos/5892046d186d7c1b6493d0cb/master/pass/embed-silje-norendal-snowboard-cold-weather-beauty-products.jpg',
            'https://assets.vogue.com/photos/5892046d186d7c1b6493d0cb/master/pass/embed-silje-norendal-snowboard-cold-weather-beauty-products.jpg',
            'https://assets.vogue.com/photos/5892046d186d7c1b6493d0cb/master/pass/embed-silje-norendal-snowboard-cold-weather-beauty-products.jpg',
            'https://assets.vogue.com/photos/5892046d186d7c1b6493d0cb/master/pass/embed-silje-norendal-snowboard-cold-weather-beauty-products.jpg',
            'https://assets.vogue.com/photos/5892046d186d7c1b6493d0cb/master/pass/embed-silje-norendal-snowboard-cold-weather-beauty-products.jpg',
            'https://assets.vogue.com/photos/5892046d186d7c1b6493d0cb/master/pass/embed-silje-norendal-snowboard-cold-weather-beauty-products.jpg',
            'https://assets.vogue.com/photos/5892046d186d7c1b6493d0cb/master/pass/embed-silje-norendal-snowboard-cold-weather-beauty-products.jpg',
        ];

        return $this->render('homepage.html.twig', [
            'tricks' => $tricks,
            'images' => $images,
        ]);
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