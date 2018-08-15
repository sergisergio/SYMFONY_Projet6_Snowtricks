<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class AuthenticationController
 * @package App\Controller
 */
class AuthenticationController extends AbstractController
{
  /**
     * @Route("/inscription", name="signuppage")
     */
    function signupPage(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            // Il faudra que je traite le token, le rôle et le isActive
            $user->setToken('exemple');
            $user->setRole('1');
            $user->setIsActive('1');
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('loginpage');
        }

        return $this->render(
            'security/signup.html.twig', [
                'formSignup' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/connexion", name="security_login")
     */
    function loginPage()
    {
        //$user = new User();
        /*$user->setUsername('username')
            ->setPassword('password');*/


        //$form = $this->createFormBuilder($user)
            //->add('username', TextType::class)
            //->add('password', PasswordType::class)
            //->add('save', SubmitType::class, array('label' => 'se connecter'))
            //->getForm();

        //$form->handleRequest($request);

        //if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            //but, the original '$trick' variable has also been updated
            //$user = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $entityManager = $this->>getDoctrine()->getManager();
            // $entityManager->flush()

            //return $this->redirectToRoute('homepage');
        //}

        return $this->render('security/login.html.twig');
    }

    /**
     * @Route("/deconnexion", name="security_logout")
     */
    public function logout(){

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
