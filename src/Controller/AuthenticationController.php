<?php
/**
 * This file is part of the 6th Project.
 *
 * Philippe Traon <ptraon@gmail.com>
 */
namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use App\Form\ResetPasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
/* A voir avec Karim */
/* 1. afficher seulement quand isActive est égal à 1 */
/* 2. réinitialiser le mot de passe */
/* 3. mise à jour de PHP pour installer swiftmailer->comment éviter l'export ? */
/* 4. formulaire ajout d'image */
/**
 * Class AuthenticationController
 * @package App\Controller
 */
class AuthenticationController extends AbstractController
{
    /**
     * Page Inscription, traitement du formulaire, envoi d'un mail avec lien de confirmation
     *
     * @Route("/inscription", name="signuppage")
     */
    function signupPage(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder, \Swift_Mailer $mailer, TokenGeneratorInterface $generator)
    {
        /* Création d'un nouveau membre */
        $user = new User();
        /* Récupération du formulaire */
        $form = $this->createForm(RegistrationType::class, $user);
        /* Traitement du formulaire RegistrationType à l'aide de Request */
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /* Génération du token */
            $token = $generator->generateToken();
            /* Hashage du mot de passe */
            $hash = $encoder->encodePassword($user, $user->getPassword());
            /* Définition du mot de passe, du token, du rôle et de l'activation */
            $user->setPassword($hash);
            $user->setToken($token);
            $user->setRole('1');
            $user->setIsActive('0');
            /* Préparation de l'envoi vers la base de données */
            $manager->persist($user);
            /* Envoi vers la base de données */
            $manager->flush();
            /* Préparation du mail à l'aide de SwiftMailer */
            $message = (new \Swift_Message('Votre inscription sur SnowTricks'))
                ->setFrom('ptraon@gmail.com')
                ->setTo($user->getEmail())
                ->setBody('Lien'.'http://localhost:8000/confirm?user=' . $user->getId() . '&token=' . $token);
            /* Envoi du mail avec lien de confirmation */
            $mailer->send($message);
            /* message Flash */
            $this->addFlash(
                'info',
                'Un mail de confirmation vous a été envoyé, cliquez sur le lien pour activer votre compte.'
            );
            /* Redirection vers la page de connexion */
            return $this->redirectToRoute('security_login');
        }
        /* Affichage de la page d'inscription avec son formulaire */
        return $this->render(
            'security/signup.html.twig', [
                'formSignup' => $form->createView(),
            ]
        );
    }
    /**
     * Lien de validation contenu dans le mail : si le token est bien conforme, le compte est activé
     *
     * @Route("/confirm", name="confirm_user")
     */
    public function validate(Request $request)
    {
        /* Récupération du token dans l'URL */
        $token = $request->get('token');
        /* Erreur si pas de token */
        if (!$token) {
            return new Response(new InvalidCsrfTokenException());
        }
        /* Récupérer le User à l'aide de son identifiant */
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['id' => $request->get('user')]);
        /* Erreur si pas de User */
        if (!$user) {
            throw $this->createNotFoundException();
        }
        /* Si le token est conforme, j'active le compte et j'affiche un message Flash */
        if ($user->getToken() === $token) {
            $user->setIsActive('1');
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Votre compte a bien été activé');
        }
        /* Si tout est bon, redirection vers la page d'accueil */
        return $this->redirect('/');
    }
    /**
     * Page de connexion (Voir le fichier security.yaml)
     *
     * @Route("/connexion", name="security_login")
     */
    function loginPage()
    {
        /* Affichage de la page de connexion (Voir le fichier security.yaml) */
        return $this->render('security/login.html.twig');
    }

    /**
     * Déconnexion (Voir le fichier security.yaml)
     *
     * @Route("/deconnexion", name="security_logout")
     */
    public function logout(){}

    /**
     * Page "mot de passe oublié"
     *
     * @Route("/forgotpassword", name="forgotpasswordpage")
     */
    function forgotPasswordPage(Request $request, \Swift_Mailer $mailer, TokenGeneratorInterface $generator)
    {
        // Création d'un nouvel objet user
        $user = new User();
        // Ajout du formulaire avec un champ email
        $form = $this->createFormBuilder($user)
            ->add('email', EmailType::class)
            ->add('save', SubmitType::class, array('label' => 'envoyer'))
            ->getForm();
        // Traitement des données du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            // $form->getData() holds the submitted values
            //but, the original '$trick' variable has also been updated
            $user = $form->getData();
            $email = $user->getEmail();
            // Lien avec le repository User pour utiliser une méthode find pour trouver la ligne correspondant à l'utilisateur
            $repository = $this->getDoctrine()->getRepository(User::class);
            $userReset = $repository->findOneBy(['email' => $email]);
            // Je génère un resetToken que je sette puis envoi dans la base de données
            $token = $generator->generateToken();
            $userReset->setResetToken($token);
            $this->getDoctrine()->getManager()->flush();

            // si on a bien l'utilisateur
            if ($userReset){
                /* Préparation du mail à l'aide de SwiftMailer */
                $message = (new \Swift_Message('Réinitialisation de votre mot de passe'))
                    ->setFrom('ptraon@gmail.com')
                    ->setTo($user->getEmail())
                    ->setBody('http://localhost:8000/resetpassword?user=' . $userReset->getId() . '&token=' . $token);
                /* Envoi du mail avec lien de confirmation */
                $mailer->send($message);
                $this->addFlash(
                    'info',
                    'Un mail vous a été envoyé, cliquez sur le lien pour réinitialiser votre mot de passe.'
                );
            }

            // redirection vers la page d'accueil avec message flash
            return $this->redirectToRoute('homepage');
        }
        // Affichage de la page "mot de passe oublié" avec son formulaire
        return $this->render(
            'security/forgotpasswordpage.html.twig', [
                'formForgotPassword' => $form->createView(),
            ]
        );
    }
    /**
     * Page pour réinitialiser son mot de passe
     *
     * @Route("/resetpassword", name="resetpasswordpage")
     */
    function resetPasswordPage(Request $request, UserPasswordEncoderInterface $encoder)
    {
        /*Récupération du token dans l'URL */
        $token = $request->get('token');
        /* Erreur si pas de token */
        if (!$token) {
            return new Response(new InvalidCsrfTokenException());
        }
        /* Récupérer le User à l'aide de son token */
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['resetToken' => $request->get('token')]);
        /* Erreur si pas de User */
        if (!$user) {
            throw $this->createNotFoundException();
        }
        /* vérification du token */
        if ($user->getResetToken() !== $token) {
            throw $this->createNotFoundException();
        }

        // Récupération du formulaire resetPasswordType
        $form = $this->createForm(ResetPasswordType::class, $user);
        // Traitement du formulaire
        $form->handleRequest($request);


            if ($form->isSubmitted()) {
                // Récupération et chiffrage du mot de passe
                $password = $form->getData();
                $hash = $encoder->encodePassword($password, $user->getPassword());
                // Définition du mot de passe et remise à zéro du ResetToken
                $user->setPassword($hash);
                $user->setResetToken('');
                // Envoi vers la base de données
                $this->getDoctrine()->getManager()->flush();
                // Message Flash
                $this->addFlash('success', 'Votre mot de passe a bien été réinitialisé !');
                // redirection vers
                return $this->redirectToRoute('security_login');
            }
        return $this->render(
            'security/resetpasswordpage.html.twig', [
                'formResetPassword' => $form->createView(),
            ]
        );
    }
}
