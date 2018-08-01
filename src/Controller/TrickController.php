<?php
/**
 * Created by PhpStorm.
 * User: leazygomalas
 * Date: 22/07/2018
 * Time: 19:40
 */

namespace App\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Trick;

class TrickController extends AbstractController
{
    /**
     * @Route("/add/trick/new")
     */
    public function new(EntityManagerInterface $em)
    {
        //return new Response('ajouter un trick');
        $trick = new Trick();
        $trick->setName('Page pour ajouter un trick')
            ->setSlug('nom d\'un trick'.rand(100, 999))
            ->setDescription('DESCRIPTIONNNNNNNNN')
            ->setCreatedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));

        $em->persist($trick);
        $em->flush();

        return new Response(sprintf(
            'Hiya! New Trick id: #%d slug: %s',
            $trick->getId(),
            $trick->getSlug()
        ));
    }

    /**
     * @Route("/")
     */
    public function show(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Trick::class);
        $trick = $repository->findAll();

        return $this->render('homepage.html.twig', [
            'tricks' => $trick,
        ]);
    }


}