<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Trick;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends AbstractController
{

    /**
     * @Route("/", name="homepage")
     */
    public function show(EntityManagerInterface $em)
    {
        $repo = $em->getRepository(Trick::class);
        $tricks = $repo->findAll();

        return $this->render('homepage.html.twig', [
            'tricks' => $tricks,
        ]);
    }
}
