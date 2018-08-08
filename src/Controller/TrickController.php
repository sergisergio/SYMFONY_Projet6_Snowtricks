<?php
/**
 * Created by PhpStorm.
 * User: leazygomalas
 * Date: 22/07/2018
 * Time: 19:40
 */

namespace App\Controller;


use App\Entity\Category;
use App\Entity\Comment;
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
        $trick->setName('Trick Name')
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
     * @Route("/trick/{name}/{id}", name="app_trickpage")
     */
    function trickPage($id, $name, EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Trick::class);
        $trick = $repository->findOneBy(['id' => $id]);

        $repository = $em->getRepository(Comment::class);
        $comments = $repository->findAll();

        $catRepository = $em->getRepository(Category::class);
        $categories = $catRepository->findOneBy(['name' => $name]);

        return $this->render('trick.html.twig', [
            'trick' => $trick,
            'comments' => $comments,
            'category' => $categories,
        ]);
    }

    /**
     * @Route("/add/trick", name="app_createtrickpage")
     */
    public function add()
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
}
