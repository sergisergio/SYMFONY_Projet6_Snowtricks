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
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

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
        // 1) Construction du formulaire
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);

        // 2) Traitement du formulaire RegistrationType à l'aide de Request
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Génération du password hashé, du token et des champs non nullables
            $token = $generator->generateToken();

            $hash = $encoder->encodePassword($user, $user->getPlainPassword());

            $user->setPassword($hash);
            $user->setToken($token);
            $user->setRole('1');
            $user->setIsActive('0');
            // 4) Sauvegarde de l'utilisateur
            $manager->persist($user);
            $manager->flush();

            // 5) Envoi du mai avec lien de confirmation
            $message = (new \Swift_Message('Votre inscription sur SnowTricks'))
                ->setFrom('ptraon@gmail.com')
                ->setTo($user->getEmail())
                ->setBody('Validez votre compte en cliquant sur ce <a href="http://localhost:8000/confirm?user=' . $user->getId() . '&token=' . $token . '">LIEN</a>', 'text/html');

            $mailer->send($message);

            // 6) Message Flash
            $this->addFlash(
                'info',
                'Un mail de confirmation vous a été envoyé, cliquez sur le lien pour activer votre compte.'
            );

            // 7) Redirection vers la page de login
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
     * @Route("/CGU", name="conditions")
     */
    public function conditions()
    {
        return $this->render('conditions/cgu.html.twig');
    }

    /**
     * Lien de validation contenu dans le mail : si le token est bien conforme, le compte est activé
     *
     * @Route("/confirm", name="confirm_user")
     */
    public function validate(Request $request)
    {
        // 1) récupération du token dans l'URL
        $token = $request->get('token');

        /* Erreur si pas de token */
        if (!$token) {
            return new Response(new InvalidCsrfTokenException());
        }

        // 2) Récupérer le User à l'aide de son identifiant
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['id' => $request->get('user')]);

        /* Erreur si pas de User */
        if (!$user) {
            throw $this->createNotFoundException();
        }

        // 3) Si le token est conforme, j'active le compte et j'affiche un message Flash
        if ($user->getToken() === $token) {
            $user->setIsActive('1');
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Votre compte a bien été activé');
        }

        // 4) Si tout est bon, redirection vers la page d'accueil
        return $this->redirecttoRoute('security_login');
    }
    /**
     * Page de connexion (Voir le fichier security.yaml)
     *
     * @Route("/connexion", name="security_login")
     */
    function loginPage(AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        /* Affichage de la page de connexion (Voir le fichier security.yaml) */
        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
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
        // 1) Création duf ormulaire
        $user = new User();
        $form = $this->createFormBuilder($user)
            ->add('email', EmailType::class)
            //->add('save', SubmitType::class, array('label' => 'envoyer'))
            ->getForm();

        // 2) Traitement des données du formulaire
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            // 3) Vérification du mail et génération d'un token
            $user = $form->getData();
            $email = $user->getEmail();
            // Lien avec le repository User pour utiliser une méthode find pour trouver la ligne correspondant à l'utilisateur
            $repository = $this->getDoctrine()->getRepository(User::class);
            $userReset = $repository->findOneBy(['email' => $email]);
            // Je génère un resetToken que je sette puis envoi dans la base de données
            $token = $generator->generateToken();
            $userReset->setResetToken($token);

            // 4) Envoi du token dans la base de données
            $this->getDoctrine()->getManager()->flush();

            // si on a bien l'utilisateur
            if ($userReset){
                // 5) Envoi du mail avec lien
                $message = (new \Swift_Message('Réinitialisation de votre mot de passe'))
                    ->setFrom('ptraon@gmail.com')
                    ->setTo($user->getEmail())
                    ->setBody('<a href="http://localhost:8000/resetpassword?user=' . $userReset->getId() . '&token=' . $token . '">Réinitialiser votre mot de passe</a>', 'text/html');
                /* Envoi du mail avec lien de confirmation */
                $mailer->send($message);

                // 6) Message Flash
                $this->addFlash(
                    'info',
                    'Un mail vous a été envoyé, cliquez sur le lien pour réinitialiser votre mot de passe.'
                );
            }

            // 7) redirection vers la page d'accueil avec message flash
            return $this->redirectToRoute('security_login');
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
        // 1) Récupération du token dans l'URL
        $token = $request->get('token');

        /* Erreur si pas de token */
        if (!$token) {
            return new Response(new InvalidCsrfTokenException());
        }

        // 2) Récupérer le User à l'aide de son token
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['resetToken' => $request->get('token')]);

        /* Erreur si pas de User */
        if (!$user) {
            throw $this->createNotFoundException();
        }

        // 3) vérification du token
        if ($user->getResetToken() !== $token) {
            throw $this->createNotFoundException();
        }

        // 4) Récupération du formulaire resetPasswordType
        $form = $this->createForm(ResetPasswordType::class, $user);

        // 5) Traitement du formulaire
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 6) Récupération et chiffrage du mot de passe
            $password = $form->getData();
            $hash = $encoder->encodePassword($password, $user->getPlainPassword());

            // 7) Définition du mot de passe et remise à zéro du ResetToken
            $user->setPassword($hash);
            $user->setResetToken('');

            // 8) Envoi vers la base de données
            $this->getDoctrine()->getManager()->flush();

            // 9) Message Flash
            $this->addFlash('success', 'Votre mot de passe a bien été réinitialisé !');

            // 10) redirection
            return $this->redirectToRoute('security_login');
        }
        return $this->render(
            'security/resetpasswordpage.html.twig', [
                'formResetPassword' => $form->createView(),
            ]
        );
    }
}
