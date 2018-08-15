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
use App\Entity\Media;
use App\Entity\User;
use App\Entity\Trick;
use App\Repository\CategoryRepository;
use App\Repository\CommentRepository;
use App\Repository\MediaRepository;
use App\Repository\TrickRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use App\Form\AddTrickType;

class TrickController extends AbstractController
{
    /**
     * @Route("/trick/{name}/{id}", name="trickpage")
     */
    function trickPage($name, $id, TrickRepository $repoTrick, CommentRepository $repoComment, CategoryRepository $repoCategory, MediaRepository $repoMedia, UserRepository $repoUser)
    {
        //$repo = $em->getRepository(Trick::class);
        $trick = $repoTrick->find(['id' => $id]);

        //$repo = $em->getRepository(Comment::class);
        $comments = $repoComment->findAll();

        //$catRepo = $em->getRepository(Category::class);
        $categories = $repoCategory->findOneBy(['name' => $name]);

        //$mediaRepo = $em->getRepository(Media::class);
        $media = $repoMedia->findAll();
        $medium = $repoMedia->findOneBy(['url' => 'https://image.redbull.com/rbcom/010/2015-04-15/1331717228402_2/0010/1/1500/1000/1/billy-morgan-lands-first-ever-snowboard-quad-cork.jpg']);

        //$repo= $em->getRepository(User::class);
        $author = $repoUser->findOneBy(['username' => 'Philippe Traon']);

        return $this->render('trick.html.twig', [
            'trick' => $trick,
            'comments' => $comments,
            'category' => $categories,
            'media' => $media,
            'medium' => $medium,
            'author' => $author,

        ]);
    }

    /**
     * @Route("/add/trick", name="createtrickpage")
     * @Route("/modifytrick/{id}", name="modifytrickpage")
     */
    public function add(Trick $trick = null, Request $request, ObjectManager $manager)
    {
        if (!$trick) {
        $trick = new Trick();
        }
        /*$trick->setName('nameform')
            ->setSlug('slugform')
            ->setDescription('descriptionform')
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());*/


        //$form = $this->createFormBuilder($trick)
            //->add('name', TextType::class)
            //->add('slug', TextType::class)
            //->add('description', TextareaType::class)

            //->add('save', SubmitType::class, array('label' => 'create trick'))
            //->getForm();

        $form = $this->createForm(AddTrickType::class, $trick);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             //$form->getData();  holds the submitted values
            /*but, the original '$trick' variable has also been updated*/
            //$trick = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
             //$entityManager = $this->getDoctrine()->getManager();
            if (!$trick->getId()) {
                $trick->setCreatedAt(new \DateTime());

            }
            $manager->persist($trick);
            $manager->flush();


            return $this->redirectToRoute('trickpage', ['id' => $trick->getId()]);
        }

        return $this->render(
            'createtrick.html.twig', [
                'formAddTrick' => $form->createView(),
                'editMode' => $trick->getId() !== null
            ]);
    }


     /* Route("/modifytrick/{id}", name="modifytrickpage")*/

    /*function modifyTrickPage(Request $request)
    {
        //$repository = $em->getRepository(Trick::class);
        //$trick = $repository->findOneBy(['id' => $id]);
        //return $this->render('modifytrick.html.twig', [
        //    'trick' => $trick,
        //]);
        $trick = new Trick();
        /*$trick->setName('nameform')
            ->setSlug('slugform')
            ->setDescription('descriptionform')
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());*/


        /*$form = $this->createFormBuilder($trick)
            ->add('name', TextType::class)
            ->add('slug', TextType::class)
            ->add('description', TextareaType::class)
            ->add('save', SubmitType::class, array('label' => 'modify trick'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            //but, the original '$trick' variable has also been updated
            $trick = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $entityManager = $this->>getDoctrine()->getManager();
            // $entityManager->flush()

            return $this->redirectToRoute('homepage');
        }

        return $this->render(
            'modifytrick.html.twig', [
                'formModifyTrick' => $form->createView(),
            ]
        );

    }*/

    /**
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

        return $this->redirectToRoute('homepage', [
            'id' => $trick->getId()
        ]);
    }
}
