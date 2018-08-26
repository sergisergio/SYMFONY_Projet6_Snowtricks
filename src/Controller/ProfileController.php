<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile/{id}", name="profile")
     */
    public function profile($id, UserRepository $repoUser, Request $request, ObjectManager $manager)
    {
        $user = $repoUser->find(['id' => $id]);

        if (!$user) {
            return $this->render('404.html.twig');
        }
        return $this->render('profile/profile.html.twig', [
            'user' => $user,
        ]);
    }
}
