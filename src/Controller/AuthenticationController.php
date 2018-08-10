<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/signup", name="signuppage")
     */
    function signupPage(Request $request)
    {
        $user = new User();
        /*$user->setUsername('username')
            ->setEmail('email')
            ->setPassword('password');*/


        $form = $this->createFormBuilder($user)
            ->add('username', TextType::class)
            ->add('password', PasswordType::class)
            ->add('save', SubmitType::class, array('label' => 's\'inscrire'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            //but, the original '$trick' variable has also been updated
            $user = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $entityManager = $this->>getDoctrine()->getManager();
            // $entityManager->flush()

            return $this->redirectToRoute('homepage');
        }

        return $this->render(
            'signup.html.twig', [
                'formSignup' => $form->createView(),
            ]
        );

    }

    /**
     * @Route("/login", name="loginpage")
     */
    function loginPage(Request $request)
    {
        $user = new User();
        /*$user->setUsername('username')
            ->setPassword('password');*/


        $form = $this->createFormBuilder($user)
            ->add('username', TextType::class)
            ->add('password', PasswordType::class)
            ->add('save', SubmitType::class, array('label' => 'se connecter'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            //but, the original '$trick' variable has also been updated
            $user = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $entityManager = $this->>getDoctrine()->getManager();
            // $entityManager->flush()

            return $this->redirectToRoute('homepage');
        }

        return $this->render(
            'login.html.twig', [
                'formLogin' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/forgotpassword", name="forgotpasswordpage")
     */
    function forgotPasswordPage(Request $request)
    {
        $user = new User();
        //$user->setEmail('email');


        $form = $this->createFormBuilder($user)
            ->add('email', EmailType::class)
            ->add('save', SubmitType::class, array('label' => 'envoyer'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            //but, the original '$trick' variable has also been updated
            $user = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $entityManager = $this->>getDoctrine()->getManager();
            // $entityManager->flush()

            return $this->redirectToRoute('homepage');
        }

        return $this->render(
            'forgotpasswordpage.html.twig', [
                'formForgotPassword' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/resetpassword", name="resetpasswordpage")
     */
    function resetPasswordPage(Request $request)
    {
        $user = new User();
        //$user->setPassword('password');


        $form = $this->createFormBuilder($user)
            ->add('password', PasswordType::class)
            ->add('save', SubmitType::class, array('label' => 'réinitialiser'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            //but, the original '$trick' variable has also been updated
            $user = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $entityManager = $this->>getDoctrine()->getManager();
            // $entityManager->flush()

            return $this->redirectToRoute('homepage');
        }

        return $this->render(
            'resetpasswordpage.html.twig', [
                'formResetPassword' => $form->createView(),
            ]
        );
    }
}
