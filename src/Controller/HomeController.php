<?php
/**
 * This file is part of the 6th Project.
 *
 * Philippe Traon <ptraon@gmail.com>
 */
namespace App\Controller;

use App\Entity\Media;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Trick;

/**
 * This controller gives the homepage
 *
 * Class HomeController
 * @package App\Controller
 *
 * @author Philippe Traon <ptraon@gmail.com>
 */
class HomeController extends AbstractController
{
    /**
     * Liste de tous les tricks
     *
     * @Route("/", name="homepage")
     */
    public function show(EntityManagerInterface $em)
    {
        $repo = $em->getRepository(Trick::class);
        $tricks = $repo->findAll();
        $repo = $em->getRepository(Media::class);
        $media = $repo->findAll();

        return $this->render('homepage.html.twig', [
            'tricks' => $tricks,
            'media' => $media
        ]);
    }
}
