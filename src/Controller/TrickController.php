<?php
/**
 * This file is part of the 6th Project.
 *
 * Philippe Traon <ptraon@gmail.com>
 */

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\User;
use App\Entity\Trick;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use App\Repository\MediaRepository;
use App\Repository\TrickRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use App\Form\AddTrickType;
use App\Utils\Slugger;

/**
 *  This controller manages all tricks : show, add, modify and delete
 *
 * Class TrickController
 * @package App\Controller
 *
 * @author Philippe Traon <ptraon@gmail.com>
 */
class TrickController extends AbstractController
{
    /**
     * Show one trick, its details and its comments
     *
     * @Route("/trick/{slug}", name="trickpage")
     */
    function trickPage($slug, TrickRepository $repoTrick, CommentRepository $repoComment, MediaRepository $repoMedia, Request $request, ObjectManager $manager)
    {
        // Trouver un trick grâce à son id
        $trick = $repoTrick->findOneBy(['slug' => $slug]);
        //$trick = $this->getDoctrine()->getRepository(Trick::class)->find($slug);
        if (!$trick) {
            return $this->render('404.html.twig');
        }
        // Trouver tous les commentaires
        $comments = $repoComment->findAll();
                //$catRepo = $em->getRepository(Category::class);
                // Je ne passe plus par entitymanager mais directement par le repository....
        //$categories = $repoCategory->findOneBy(['name' => $name]);
                //$mediaRepo = $em->getRepository(Media::class);
                // Je ne passe plus par entitymanager mais directement par le repository....
        $type= 'i';
        $type2 = 'v';
        $media = $repoMedia->findMediaByTrick($slug, $type);
        $video = $repoMedia->findMediaByTrick($slug, $type2);

        $medium = $repoMedia->findOneBy(['url' => 'https://image.redbull.com/rbcom/010/2015-04-15/1331717228402_2/0010/1/1500/1000/1/billy-morgan-lands-first-ever-snowboard-quad-cork.jpg']);
                //$repo= $em->getRepository(User::class);
                // Je ne passe plus par entitymanager mais directement par le repository....
                //$author = $repoUser->findOneBy(['username' => 'Philippe Traon']);

        $comment = new Comment();
        $comment->setAuthor($this->getUser());

        //$comment->setTrick($trick);
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
                // Analyse de la requête envoyée via le formulaire CommentType basé sur l'objet $comment créé juste avant

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setCreatedAt(new \DateTime())
                ->setTrick($trick);
            //$trick->addComment($comment);

            $manager->persist($comment);
            $manager->flush();
            // Flash messages are used to notify the user about the result of the
            // actions. They are deleted automatically from the session as soon
            // as they are accessed.
            // See https://symfony.com/doc/current/book/controller.html#flash-messages
            $this->addFlash('success', 'Votre message a bien été ajouté!');



            return $this->redirectToRoute('trickpage', ['slug' => $trick->getSlug()]);
        }

        return $this->render('Trick/trick.html.twig', [
            'trick' => $trick,
            'comments' => $comments,
            //'category' => $categories,
            'media' => $media,
            'medium' => $medium,
            'video' => $video,
            //'author' => $author,
            'commentForm' => $form->createView(),

        ]);
        // Est-ce-que j'ai besoin de tout ? Je peux utiliser un paramconverter ?
    }

    /**
     * @Route("/trick/")
     * @Route("/modifytrick/")
     */
    public function noTrick() {
        return $this->render('404.html.twig');
    }

    /**
     * Add a trick
     *
     * @Route("/add/trick", name="createtrickpage")
     *
     */
    public function add(Request $request, ObjectManager $manager)
    {
        //if (!$trick) {
        $trick = new Trick();


        //}
        //$categories = $repoCategory->findOneBy(['name' => $name]);

        $form = $this->createForm(AddTrickType::class, $trick);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $trick->setSlug(Slugger::slugify($trick->getName()));
            $trick->setAuthor($this->getUser());
            $trick->setCreatedAt(new \DateTime());
            $manager->persist($trick);
            $manager->flush();

            //$this->addFlash('success', 'Le trick a bien été ajouté!');
            //return $this->redirectToRoute('trickpage', ['slug' => $trick->getSlug()]);

            return $this->redirectToRoute('addMedia');

        }

        return $this->render(
            'Trick/createtrick.html.twig', [
                'formAddTrick' => $form->createView()
            ]);
    }

    /**
     * Modify a trick
     *
     * @Route("/modifytrick/{id}", name="modifytrickpage")
     */
    function modifyTrickPage(int $id, Trick $trick, Request $request, ObjectManager $manager)
    {
        $trick = $this->getDoctrine()->getRepository(Trick::class)->find($id);
        $form = $this->createForm(AddTrickType::class, $trick);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($trick);
            $manager->flush();

            //if (!$trick->getId()) {
            $this->addFlash('success', 'Le trick a bien été modifié!');
            //}
            //else
            //$this->addFlash('success', 'Le trick a bien été modifié!');
            return $this->redirectToRoute('trickpage', ['name' => $trick->getCategory(), 'slug' => $trick->getSlug()]);
        }
        return $this->render('Trick/modifytrick.html.twig', [
            'trick' => $trick,
            'formAddTrick' => $form->createView()
        ]);
        // Idem ! Ne serait-ce pas mieux d'utiliser un paramconverter ?
    }

    /**
     * Delete a trick
     *
     * @Route("/delete/{id}", name="deletetrick")
     *
     * @return Response
     */
    public function deleteTrick($id, EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Trick::class);
        $trick = $repository->find($id);

        //if(!$trick)
            //throw $this->createNotFoundException('No trick found for id'.$id);

        //$em = $this->getDoctrine()->getManager();
        $em->remove($trick);
        $em->flush();

        $this->addFlash('message', 'Le trick a bien été supprimé');

        return $this->redirectToRoute('homepage');
        // Idem : paramconverter ?
    }
}
